window.onload = function(){

    var forms = document.getElementsByTagName('form');
    for (var j=0, l=forms.length; j<l; j++)
    {
          document.forms[j].onsubmit = function () {
                var inputs = document.forms[this.name].getElementsByTagName('input');
                var checked = []; //will contain all checked checkboxes
                for (var i=0, l=inputs.length; i<l; i++)
                {
                    if(inputs[i].className == 'required')
                    {
                        var el = document.getElementsByClassName('error_'+inputs[i].name);
                        el[0].innerHTML = "";
                        if(inputs[i].value == "")
                        {
                            if(el[0].innerHTML == "")
                            {
                                el[0].appendChild( document.createTextNode("This field is required" ));
                            }
                        }
                        if(inputs[i].type=='checkbox')
                        {
                            if (inputs[i].checked == false) {
                               if(el[0].innerHTML == "")
                                {
                                    el[0].appendChild( document.createTextNode( "This field is required" ));
                                }
                            }                            
                        }
                        if(inputs[i].type=='radio')
                        {
                            if (inputs[i].checked) {
                                checked.push(inputs[i]);                                
                            }
                            if(el[0].innerHTML == "" && checked.length == 0)
                            {
                                el[0].appendChild( document.createTextNode( "This field is required" ));
                            }
                            
                        }
                    }
                }
                var selects = document.forms[this.name].getElementsByTagName('select');
                for (var k=0, l=selects.length; k<l; k++)
                {
                    if(selects[k].className == 'required'){
                        var el = document.getElementsByClassName('error_'+selects[k].name);
                        el[0].innerHTML = "";
                        if(selects[k].value == "")
                        {
                            if(el[0].innerHTML == "")
                            {
                                el[0].appendChild( document.createTextNode( "This field is required" ));
                            }
                        }
                    }
                }
                var textarea = document.forms[this.name].getElementsByTagName('textarea');
                for (var n=0, l=textarea.length; n<l; n++)
                {
                    if(textarea[n].className == 'required'){
                        var el = document.getElementsByClassName('error_'+textarea[n].name);
                        el[0].innerHTML = "";
                        if(textarea[n].value == "")
                        {
                            if(el[0].innerHTML == "")
                            {
                                el[0].appendChild( document.createTextNode( "This field is required" ));
                            }
                        }
                    }
                }
                return false;
          }
    }
}