<?php
namespace App\Helpers;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageResizer{

    public static function regenerateAvatarSize($name="mini-medium",$photo){
        if( is_object($photo) ){
            $temp = $photo->filename  ;
            $photo = $temp;
        }
        $avatarDir =  public_path("uploads/" . self::$directory . "/");
        $avatarDirResize =  public_path("uploads/" .  self::$directoryResize . "/");
        if( file_exists($avatarDir . $photo) && is_file($avatarDir . $photo) ){

            $img = Image::make($avatarDir . $photo);
            $imageSize = self::$aImageSize[$name];


            //$img->resize($imageSize[0], $imageSize[1]);
//            $img->heighten($imageSize[1], function ($constraint) {
//                $constraint->upsize();
//            });

            $img->resize($imageSize[0], $imageSize[1]);

            if( !file_exists($avatarDirResize . $name) || !is_dir($avatarDirResize . $name)  ){
                if( !file_exists($avatarDirResize) || !is_dir($avatarDirResize)  )
                    mkdir( $avatarDirResize );
                mkdir( $avatarDirResize . $name  );
            }
            $img->save($avatarDirResize . $name . "/" . $photo );
        }
    }

    public static function regenerateAllAvatar( ){
        $toRecord = self::all();
        foreach( $toRecord as $oRecord ){
            foreach( self::$aImageSize as $imageKey => $imageSize ){
                $zPhoto = "";

                if( method_exists($oRecord,'getImageRaw') ){
                    $media = $oRecord->getImageRaw();
                    if( isset($media->filename) ){
                        $zPhoto = $media->filename . '.' . $media->extension ;
                    }
                }else{
                    $tmImage = $oRecord->image()->first();
                    if( count($tmImage) ){
                        $zPhoto = $tmImage->filename ;
                    }
                }

                if( $zPhoto ){
                    self::regenerateAvatarSize($imageKey,$zPhoto);
                }
            }
        }
    }

    public static function regenerateMyAvatar($photos){
        //$obj = new ImageResizerC();
        if( !isset(self::$aImageSize) ){
            self::$aImageSize = ImageResizerC::$tmDefaultImageSize;
        }

        foreach( self::$aImageSize as $imageKey => $imageSize ){
            self::regenerateAvatarSize($imageKey,$photos);
        }
    }

    public function getAvatar($name="mini-medium"){
        $avatarDirResize =  public_path("uploads/" . self::$directoryResize . "") . "/" . $name . "/";
        $avatarDir =  public_path("uploads/" . self::$directory . "/");

        $zPhoto = "";
        if( method_exists($this,'getImageRaw') ){
            $media = $this->getImageRaw();
            if( isset($media->filename) ){
                $zPhoto = $media->filename . '.' . $media->extension ;
            }
        }else{
            $tmImage = $this->image()->first();
            if( $tmImage->count() ){
                $zPhoto = $tmImage->filename ;
            }
        }

        $photos = $zPhoto;

        if( $name == "original" ){
            return asset('uploads/' . self::$directory . '/' . $photos );
        }

        if( file_exists($avatarDirResize . $photos) || is_file($avatarDirResize . $photos) ) {
            return asset('uploads/' . self::$directoryResize . '/' . $name . "/" . $photos );
        }else{
            if( file_exists($avatarDir. $photos) || is_file($avatarDir . $photos) ){
                self::regenerateAvatarSize($name,$photos);
                return asset('uploads/' . self::$directoryResize . '/' . $name . "/" . $photos );
            }else{
                $imageSize = self::$aImageSize[$name];
                return "http://placehold.it/" . $imageSize[0] . "x" . $imageSize[1];
            }
        }
    }
}