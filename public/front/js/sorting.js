try{$('html').addClass('js')}catch(e){}$(document).ready(function(){try{}catch(e){}try{var $container=$('.projects');if($container!=null&&$container.length>0){$container.isotope({resizable:false,masonry:{columnWidth:$container.width()/12}});$(window).smartresize(function(){$container.isotope({masonry:{columnWidth:$container.width()/12}})});$container.isotope({itemSelector:'.element',animationOptions:{duration:750,easing:'linear',queue:true}});var $optionSets=$('#options .option-set'),$optionLinks=$optionSets.find('a');$optionLinks.click(function(){var $this=$(this);if($this.hasClass('selected')){return false}var $optionSet=$this.parents('.option-set');$optionSet.find('.selected').removeClass('selected');$this.addClass('selected');var options={},key=$optionSet.attr('data-option-key'),value=$this.attr('data-option-value');value=value==='false'?false:value;options[key]=value;if(key==='layoutMode'&&typeof changeLayoutMode==='function'){changeLayoutMode($this,options)}else{$container.isotope(options)}return false})}}catch(e){}});
