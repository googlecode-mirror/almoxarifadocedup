// função sem utilidade por enquanto//
function openAjax(){
    var ajax;
    try{
        ajax = new XMLHttpRequest();
    } catch(ee){
        try{
            ajax = new ActiveXObject("Msxm12.XMLHTTP");
        } catch(e){
            try {
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");     
            } catch (E){
                    ajax = false;
              }
          }
    
    }
    return ajax;
}






