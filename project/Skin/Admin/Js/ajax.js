var ajax = {
    url : null,
    method : 'POST',
    dataType : 'json',
    params : {},
    form : '',
    setParams : function(params){
        this.params = params;
        return this;
    },
    getParams : function(){
        return this.params;
    },
    setUrl : function(url){
        this.url = url;
        return this;
    },
    getUrl : function(){
        return this.url;
    },
    setMethod : function(method){
        this.method = method;
        return this;
    },
    getMethod : function(){
        return this.method;
    },
    setDataType : function(dataType){
        this.dataType = dataType;
        return this; 
    },
    getDataType : function(){
        return this.dataType;
    },
    setForm : function(form){
        form = jQuery('#'+form);
        if(typeof(form) !== 'object'){
            return false;
        }
        this.form = form;
        this.setParams(new FormData(form[0]));
        this.setUrl(this.form.attr('action'));
        this.setMethod(this.form.attr('method'));
        return this;
    },
    getForm : function(){
        return this.form;
    },
    manageHtml : function(data){
        if(typeof(data) !== 'object'){
            return false;
        }
        
        if(typeof(data.elements) !== 'object'){
            return false
        }
        data.elements.forEach(function(element){
            if(typeof(element.elementId) === 'string'){
                jQuery('#'+element.elementId).html(element.html);
            }

            if(typeof(element.identifier) === 'string'){
                if(element.class.remove != undefined){
                    jQuery(element.identifier+" .active").removeClass('active');
                }
            }

            if(typeof(element.identifier) === 'string'){
                if(element.class.add != undefined){
                    jQuery(element.identifier).addClass(element.class.add);
                }
                
                if(element.class.html != undefined){
                    jQuery(element.identifier).attr('value',element.class.html);
                    jQuery(element.identifier).attr('disabled',true);
                }
            } 
        })
    },
    load : function(){
        $.ajax({
            url : this.getUrl(),
            method : this.getMethod(),
            data : this.getParams(),
            dataType : this.getDataType(),
            processData: false,
            contentType: false,
            success : (function(data){
                ajax.manageHtml(data);
            })
        })
    },
    
    saveForm : function(){
        form = this.getForm();
        this.load();
    }
}

function selectAll(el){
    var boxes = document.getElementsByName('check[]');
    if(el.checked){
        for(i=0;i<boxes.length;i++){
            boxes[i].checked=true;
        }
    }
    else{
        for(i=0;i<boxes.length;i++){
            boxes[i].checked=false;
        }
    }
}

function changeCustomer(el,url){
    ajax.setUrl(url+"&cid="+el.value).load();
}