$('#glasaj').click(function(){
    var odgovor=document.getElementsByName('odgovor');
    var izabrani='';
    var id_pitanja=$('.odgovor').data('id_pitanja');
    for(var i = 0;i<odgovor.length;i++){
        if(odgovor[i].checked){
            izabrani+=odgovor[i].value;

        }
    }
    if(izabrani==''){
        alert("Niste izabrali odgovor");
    }else{
        $.ajax({
            url:'anketa.php',
            method:'POST',
            data:{
                odgovor:izabrani,
                id_pitanja:id_pitanja
            },
            success:function(data) {
                if(data[2]==1){
                    alert("VEC STE GLASALI,VAS GLAS SE NECE RACUNATI PONOVO!");
                }
                console.log(data);
                var tabela='';
                var suma=data[0];
                tabela+='<table>';
                $.each(data[1],function(index,value){
                    tabela+=`<tr><td>${value.tekst_odgovora}:</td><td>${value.broj*100/suma}%</td></tr>`
                });
                tabela+='</table>';
                $('#anketa').html(tabela);
            },error: function(xhr, status, error) {
                var err = xhr.responseText;
                alert(err);
            }
        });
    }
});
