/*$(document).ready(function(){
        $(".edit-mesa-button").click(function(e){
            e.preventDefault();
           let fila =$(this).parents(".qMesa");
           let mesa = fila.data('mesa');
           let form = $("#formUpdate");
           //let url = form.attr('action').replace('MESA',mesa);
          // alert(url);
           let data = form.serialize();


           $.post(url, data, function(result){
           alert(result.message)
           }).fail(function(){
               alert('La mesa no fue editada');
           })
        });
});*/

