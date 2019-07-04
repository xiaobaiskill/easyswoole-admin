function post(url, datajson, callback)
{
    $.post(url,datajson,function(data){
        callback(data)
    });
}