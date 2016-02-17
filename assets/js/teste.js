(function(W){
  
  W.tooltip = function(element, options){
    
    var defaults = {corFundo : 'green', color : 'black'};
    
    var settings = options ? options : defaults;
    
    var $this = document.querySelectorAll(element);
    var qtde = $this.length;
    
    for(var i = 0; i < qtde; i++){
        $this[i].style.background = settings.corFundo;
        $this[i].style.color = settings.color;
    }
  };
  
  W.onload = function(){
      W.tooltip('.teste');
  };
  
  
})(window);