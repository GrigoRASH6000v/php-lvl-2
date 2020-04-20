function addViews(id){
    let str = "id="+id;
    $.ajax({
        type:"GET",
        url:"../src/index.php",
        data: str,
        
    })
   
}