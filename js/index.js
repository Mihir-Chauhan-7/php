var ajax = {
        url : null,
        method : 'POST',
        dataType : null,
        data : {},

        setData : function(data){
            this.data = data;
            return this;
        },
        getData : function(){
            return this.data;
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
        load : function(){
            var jqxhr = $.ajax({
                url : this.getUrl(),
                dataType : this.getDataType(),
                success : function(data) {
                    $('#'+data.elements[0].elementId).html(data.elements[0].html);
                    $('#'+data.elements[1].elementId).html(data.elements[1].html);
                }        
            });
        }    
}

ajax.setUrl("response.html");
ajax.setDataType("json");