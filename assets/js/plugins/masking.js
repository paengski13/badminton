var Masking = function () {

    return {
        
        //Masking
        initMasking: function () {
            $(".hour_minute").mask('99:99', {placeholder:'0'});
        }

    };
    
}();