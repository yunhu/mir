<?php
class FetchAction extends PreAction{
    
public function page(){

for($jj=2;$jj<=4;$jj++){
    $str=file_get_contents("http://www.67pp.com/soft/showtype.asp?page=$jj&type=");
$url='http://www.67pp.com';
$res=array();
preg_match('/\<ul id\=\"mainlistUL\"\>(.*?)\<\/ul\>/is',$str,$res);
preg_match_all('/href=\"(.*?)\"/',$res[1],$href);
preg_match_all('/title=\"(.*?)\"/',$res[1],$title);
$num=count($title[1]);
for($j=0;$j<$num;$j+=2){
    preg_match('/id\=(.*)/is',$href[1][$j+1],$nn);
    if($nn[1]>0){
        $id[$j]['id']=$nn[1];
    }else{
        $id[$j]['id']=basename($href[1][$j+1]);
    }
    $id[$j]['title']=$title[1][$j];
}
foreach($id as $k=>$v){
    $comurl="http://www.67pp.com/soft/show.asp?id=".$v['id']; 
    $comurls="http://www.67pp.com/soft/2/{$v['id']}.html"; 
    if(file_get_contents($comurl)){
    
        $this->downurl($v['title'],$comurl,$v['id'],$k,$jj);
    }
    if(file_get_contents($comurls)){
        $this->downurl($v['title'],$comurls,$v['id'],$k,$jj);
    
    }
}

}
}
public function downurl($title,$url,$nn,$j,$page){
    $str=file_get_contents($url);
    preg_match('/mainSoftIntro"\>(.*?)\<\/div\>/is',$str,$res);
    $data['uid']=1;
    $data['type']=16;
    $data['name']=iconv("gb2312","utf-8",$title);
    $data['desc']=iconv("gb2312","utf-8",$res[1])?iconv("gb2312","utf-8",$res[1]):iconv("gb2312","utf-8",$title);
    $data['apply_time']=time();
    $data['url']='sifu010.com-'.$page.'-'.$j.'.rar';
    M("Material")->add($data);
    $this->checkurl($nn,$j,$page,iconv("gb2312","utf-8",$title));
}
public function checkurl($id,$j,$page,$title){
    $mypath="H:/game/server/";
    $newname='sifu010.com-'.$page.'-'.$j.'.rar';
    $path=$mypath.$newname;
    $url="http://www.67pp.com/soft/download.asp?softid={$id}&downid=7&id=";
 
    
 if(strlen(file_get_contents( $url.($id+21)))>1800){
        file_put_contents($path,file_get_contents($url.($id+21)));
    
    }elseif(strlen(file_get_contents( $url.($id+20)))>1800){
        file_put_contents($path,file_get_contents($url.($id+20)));
    
    }elseif(strlen(file_get_contents( $url.($id+18)))>1800){
        file_put_contents($path,file_get_contents($url.($id+18)));
    
    }elseif(strlen(file_get_contents( $url.($id+17)))>1800){
        file_put_contents($path,file_get_contents($url.($id+17)));
    }elseif(strlen(file_get_contents( $url.($id+7)))>1800){
    
        file_put_contents($path,file_get_contents($url.($id+7)));
    
    }elseif(strlen(file_get_contents( $url.($id+3)))>1800){
    
        file_put_contents($path,file_get_contents($url.($id+3)));
    }elseif(strlen(file_get_contents( $url.($id+2)))>1800){
    
        file_put_contents($path,file_get_contents($url.($id+2)));
    }elseif(strlen(file_get_contents( $url.$id))>1800){
        file_put_contents($path,file_get_contents($url.$id));
    
    }elseif(strlen(file_get_contents( $url.($id-2)))>1800){
    
        file_put_contents($path,file_get_contents($url.($id-2)));
    }else{
         for($i=50;$i>=-50;$i--){
             if(strlen(file_get_contents( $url.($id+$i)))>1800){
                file_put_contents($path,file_get_contents($url.($id+$i)));
                break;
             }
         }
        
        
    }
        
        
 

}

}
?>
