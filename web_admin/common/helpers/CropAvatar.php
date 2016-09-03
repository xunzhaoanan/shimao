<?php

namespace common\helpers;

use common\vendor\upload\cdn\CDN;

/**
 * CropAvatar 裁剪控件，裁剪上传至cdn
 *
 * @author chenmh
 */
class CropAvatar
{
    private $src;
    private $data;
    private $url = null;
    private $type;
    private $msg;
    private $isSucc = false;

    function __construct($src, $data, $fromExt = false)
    {
        $this->setSrc($src, $fromExt);
        $this->setData($data);
        $this->crop($this->src, $this->data);
    }

    private function setSrc($src, $fromExt)
    {
        if (!empty($src)) {
            $type = $this->_getRealExt($src, $fromExt);

            if ($type) {
                $this->src = $src;
                $this->type = $type;
            }
        }
    }

    /**
     * 根据图片地址获取扩展
     * @param type $imgSrc
     * @return type
     */
    private function _getExt($imgSrc)
    {
        $pos = strrpos($imgSrc, ".");
        $ext = @substr($imgSrc, $pos + 1);
        if (empty($ext))
            return 'jpg';
        $exts = array('jpg', 'jpeg', 'bmp', 'gif', 'png');
        if (!in_array($ext, $exts))
            return 'jpg';
        return $ext;
    }

    /**
     * 获取后缀
     * @param type $imgSrc 文件地址
     * @return type
     */
    private function _getRealExt($imgSrc, $fromExt = false)
    {
        if ($fromExt === true) {
            return $this->_getExt($imgSrc);
        }
        $info = getimagesize($imgSrc);
        $filetype = $info['mime'];//获取实际的文件类型
        $ext = null;
        switch ($filetype) {
            case 'image/jpeg':
                $ext = 'jpg';
                break;
            case 'image/jpg':
                $ext = 'jpg';
                break;
            case 'image/pjpeg':
                $ext = 'jpg';
                break;
            case 'image/gif':
                $ext = 'gif';
                break;
            case 'image/png':
                $ext = 'png';
                break;

        }
        if ($ext === null)
            $ext = $this->_getExt($imgSrc);
        return $ext;
    }

    private function setData($data)
    {
        if (!empty($data)) {
            $this->data = json_decode(stripslashes($data));
        }
    }


    private function crop($src, $data)
    {
        if (!empty($src) && !empty($data)) {
            switch ($this->type) {
                case 'gif':
                    $src_img = imagecreatefromgif($src);
                    break;

                case 'jpg':
                    $src_img = imagecreatefromjpeg($src);
                    break;

                case 'png':
                    $src_img = imagecreatefrompng($src);
                    break;
            }

            if (!$src_img) {
                $this->msg = "Failed to read the image file";
                return;
            }

            $size = getimagesize($src);
            $size_w = $size[0]; // natural width
            $size_h = $size[1]; // natural height

            $src_img_w = $size_w;
            $src_img_h = $size_h;

            $degrees = $data->rotate;

            // Rotate the source image
            if (is_numeric($degrees) && $degrees != 0) {
                // PHP's degrees is opposite to CSS's degrees
                $new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127));

                imagedestroy($src_img);
                $src_img = $new_img;

                $deg = abs($degrees) % 180;
                $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

                $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
                $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

                // Fix rotated image miss 1px issue when degrees < 0
                $src_img_w -= 1;
                $src_img_h -= 1;
            }

            $tmp_img_w = $data->width;
            $tmp_img_h = $data->height;
            $dst_img_w = $tmp_img_w;
            $dst_img_h = $tmp_img_h;

            $src_x = $data->x;
            $src_y = $data->y;

            if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
                $src_x = $src_w = $dst_x = $dst_w = 0;
            } else if ($src_x <= 0) {
                $dst_x = -$src_x;
                $src_x = 0;
                $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
            } else if ($src_x <= $src_img_w) {
                $dst_x = 0;
                $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
            }

            if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
                $src_y = $src_h = $dst_y = $dst_h = 0;
            } else if ($src_y <= 0) {
                $dst_y = -$src_y;
                $src_y = 0;
                $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
            } else if ($src_y <= $src_img_h) {
                $dst_y = 0;
                $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
            }

            // Scale to destination position and size
            $ratio = $tmp_img_w / $dst_img_w;
            $dst_x /= $ratio;
            $dst_y /= $ratio;
            $dst_w /= $ratio;
            $dst_h /= $ratio;

            $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

            // Add transparent background to destination image
            imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagesavealpha($dst_img, true);

            $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);


            if ($result) {
                //上传到cdn
                CDN::uploadFileRaw($this->getPngStream($dst_img), date('YmdHis'), 'png');
                $res = CDN::$cdnData;
                if ($res === false) {
                    $this->msg = "裁剪失败，0001";
                } else {
                    $cdnInfo = json_decode($res, true);
                    if (!is_array($cdnInfo)) {
                        $this->msg = "裁剪失败，0002";
                    } else if (empty($cdnInfo['url'])) {
                        $this->msg = "裁剪失败，0003";
                    } else {
                        $this->url = $cdnInfo['url'];
                        $this->isSucc = true;
                    }
                }
            } else {
                $this->msg = "裁剪失败";
            }

            imagedestroy($src_img);
        }
    }

    private function getPngStream($dst_r)
    {
        // 得到处理后的图片流
        ob_start();
        imagepng($dst_r);
        $new_dst_r = ob_get_contents();
        ob_end_clean();
        //释放图片
        imagedestroy($dst_r);
        return $new_dst_r;
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                break;

            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                break;

            case UPLOAD_ERR_PARTIAL:
                $message = 'The uploaded file was only partially uploaded';
                break;

            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was uploaded';
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                $message = 'Missing a temporary folder';
                break;

            case UPLOAD_ERR_CANT_WRITE:
                $message = 'Failed to write file to disk';
                break;

            case UPLOAD_ERR_EXTENSION:
                $message = 'File upload stopped by extension';
                break;

            default:
                $message = 'Unknown upload error';
        }

        return $message;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getState()
    {
        return $this->isSucc;
    }

    public function getMsg()
    {
        return $this->msg;
    }
}
