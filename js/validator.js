window.onload = function(){

    var forms = document.getElementsByTagName('form');
    var count = forms.length;
    for (var j=0, l=count; j<l; j++)
    {
          forms[j].onsubmit = function () {
                var myFields = new Array('input', 'select', 'textarea');
                var error = false;
                var i;
                for (i in myFields)
                {
                    var elements = this.getElementsByTagName(myFields[i]);
                    var count = elements.length;
                    for (var k=0, l=count; k<l; k++)
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
                            if(elements[k].name == this.name+'_email')
                            {
                                if(elements[k].value!='')
                                {
                                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                    if (!filter.test(elements[k].value)) {
                                        error = true;
                                        el[0].appendChild( document.createTextNode("Please provide a valid email address" ));
                                    }
                                }
                            }
                        }
                    }
                   
                }
                if(error){
                    return false;
                }
                forms[j].submit();
          }
    }    
}




/*
var Object = function(){
    this.constr();
}
var Validator.prototype = Object;
Validator = {
    constr = function Validator(){
    },
    validate = function(){
        type = this.getType();
    },
    required = function (){

    },
};

var input.prototype = Validator;

input = {

}

var textarea.prototype = Validator;

var select.prototype = Validator;

var radion.prototype = input;


FormValidator.prototype = {};

function formBuilder(element){
    this.element = element;
}

var formBuilder = new formBuilder('input');
console.log(formBuilder);

function formInput(name){
    this.name = name;
}
formInput.prototype = formBuilder;
firstanme = new formInput('firstanme');
lastanme = new formInput('lastname');
console.log(firstanme.name);
console.log(lastanme.name);


function textarea(){

}

function select(){

}
function FormValidator(){

}
*/
