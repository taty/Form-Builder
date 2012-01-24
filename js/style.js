window.onload = function(){

    var forms = document.getElementsByTagName('form');
    for (var j=0, l=forms.length; j<l; j++)
    {
          document.forms[j].onsubmit = function () {
                var myFields = new Array('input', 'select', 'textarea');
                var error = false;
                var i;
                for (i in myFields)
                {
                    var elements = document.forms[this.name].getElementsByTagName(myFields[i]);
                    for (var k=0, l=elements.length; k<l; k++)
                    {
                        if(elements[k].className != '' && elements[k].className == 'required'){
                            var el = document.getElementsByClassName('error_'+elements[k].name);
                            el[0].innerHTML = "";
                            if(elements[k].value.length == 0 || (elements[k].type=='checkbox' && elements[k].checked==false)){
                                error = true;
                                el[0].appendChild( document.createTextNode("This field is required" ));                                
                            }
                            if(elements[k].type=='radio' ){
                                error = true;
                                el[0].appendChild( document.createTextNode("This field is required" ));
                                var list = document.forms[this.name][elements[k].name];
                                for(var m=0; m < list.length; m++){
                                    if(list[m].checked){
                                        error = false;
                                        el[0].innerHTML = "";
                                    }
                                }
                            }
                        }
                    }
                   
                }
                if(error){
                    return false;
                }
                document.forms[j].submit();
          }
    }
}