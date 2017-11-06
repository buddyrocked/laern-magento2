require.config({
	shim: {
		'iconpicker': {
			deps: ['jquery']
		},
        'iconpicker': ['jquery']

	}
});

require(["jquery", "Budihariyana_Social/js/itsjavi/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min"], function($, iconpicker){

    $(document).ready(function(){
        alert("Hello");
        console.log($("input").length);
        $("input[name='icon']").iconpicker({
        	iconpickerCreate:function(){
        		console.log($("input[name='icon']"));
        	}
        });
        $('#icon2').iconpicker();
	});
	
});