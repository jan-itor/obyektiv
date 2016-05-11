<?php

require 'config.php';
 
class vkExport
{
    public function getWallUploadUrl($vkGroupID, $vkAccessToken)
    {
        $query = array(
            "group_id" => $vkGroupID,
            "access_token" => $vkAccessToken           
        );
        $phRequest = "https://api.vk.com/method/photos.getWallUploadServer?".http_build_query($query);
        $ophRequest = json_decode(file_get_contents($phRequest));
         
        return  $ophRequest->response->upload_url;
    }
    
    public function GetPhotoInfo($dataFile, $uploadUrl, $vkGroupID, $vkAccessToken)
    {
        $ch = curl_init();

        //$data = array('file1' =>  '@/home/n/nep4uku/obyektiv.press/public_html/YourPicture.jpg');

        curl_setopt($ch, CURLOPT_URL, $uploadUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataFile);

        $resUpload = curl_exec($ch);
        curl_close($ch);

        $Jphoto = (json_decode($resUpload));
        $query = array(
            "group_id" => $vkGroupID,
            "photo" => $Jphoto->photo,
            "server" => $Jphoto->server,
            "hash" => $Jphoto->hash,
            "access_token" => $vkAccessToken           
        );
        $phRequestFin = "https://api.vk.com/method/photos.saveWallPhoto?".http_build_query($query);
        
        $ophRequestFin = json_decode(file_get_contents($phRequestFin));
        
        return $ophRequestFin->response[0]->id;
    }
    
     public function wallPost($_vkGroupID, $vkAccessToken, $message, $attachmentLink, $attachmentPhoto)
     {
         $attachment = $attachmentPhoto.','.$attachmentLink;
         
         $query = array(
            "owner_id" => $_vkGroupID,
            "message" =>$message,
            "attachment" => $attachment,
            "access_token" => $vkAccessToken           
        );

        $sRequest = "https://api.vk.com/method/wall.post?".http_build_query($query);
        $request = json_decode(file_get_contents($sRequest));
        return $request;
     }
     
    public function wallPostDelay($_vkGroupID, $vkAccessToken, $vkPublishDate, $message, $attachmentLink, $attachmentPhoto)
    {
        $attachment = $attachmentPhoto.','.$attachmentLink;
         
         $query = array(
            "owner_id" => $_vkGroupID,
            "publish_date" => $vkPublishDate,
            "message" =>$message,
            "attachment" => $attachment,
            "access_token" => $vkAccessToken           
        );

        $sRequest = "https://api.vk.com/method/wall.post?".http_build_query($query);
        $request = json_decode(file_get_contents($sRequest));
        return $request;
    } 
    
}


   


