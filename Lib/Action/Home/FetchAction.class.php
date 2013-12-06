<?php
class FetchAction extends PreAction{
    
public function page(){

for($jj=1;$jj<2;$jj++){
    $str=file_get_contents("http://www.67pp.com/soft/showtype.asp?page=1&type=");
$url='http://www.67pp.com';
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
        // 1  "http://www.67pp.com/soft/show.asp?id=9921";
        //2  "http://www.67pp.com/soft/2/9921.html"
/*
$x=1;
$m=0;
for($j=0;$j<$num;$j++){
    preg_match('/id\=(.*)/is',$href[1][$x],$nn);
    if($nn[1]>0){
        $this->downurl($title[1][$m],$url.$href[1][$x],$nn[1],$j,$jj); 
    }else{
    
        $this->downurl($title[1][$m],$url.$href[1][$x],intval(basename($href[1][$x])),$j,$jj); 
    }
    $x+=2;
    $m+=2;
}*/
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
    M("Material")->add($data);
    //$this->checkurl($nn,$j,$page,iconv("gb2312","utf-8",$title));
}
public function checkurl($id,$j,$page,$title){
    $mypath="E:/down/";
    $newname='sifu010.com-'.$page.'-'.$j.'.rar';
    $path=$mypath.$newname;
    $url="http://www.67pp.com/soft/download.asp?softid={$id}&downid=7&id=";
 
         for($i=50;$i>=-50;$i--){
             if(strlen(file_get_contents( $url.($id+$i)))>1800){
                file_put_contents($path,file_get_contents($url.($id+$i)));
                //file_put_contents($mypath.'/back/'.$title.'.rar',file_get_contents($path));
                break;
             }
         }
        
        
 

}

}
?>
