<?php
$upit="Select * from odgovor";
$odgovor=$kon->query($upit);
$upit2="Select * from pitanje";
$pitanje=$kon->query($upit2);
if(isset($_REQUEST['add'])){
    $name=$_REQUEST['name'];
    $id_pitanja=$_REQUEST['pitanje'];
    $upit="INSERT INTO odgovor(tekst_odgovora,id_pitanja)VALUES(:name,:id_pitanja)";
    $stmt=$kon->prepare($upit);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":id_pitanja",$id_pitanja);
    try{
        $stmt->execute();
        header("Location:".$_SERVER['HTTP_REFERER']);
    }catch (PDOException $ex){
        echo $ex->getMessage();
    }
}
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Tekst Odgovora</th>
        <th scope="col">id_pitanja</th>
        <th scope="col">Broj</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($odgovor as $o):?>
        <tr>
            <th scope="row"><?php echo $o['id']?></th>
            <td><?php echo $o['tekst_odgovora']?></td>
            <td><?php echo $o['id_pitanja']?></td>
            <td><?php echo $o['broj']?></td>
            <td><a href="#" class="users" data-table="odgovor" data-id="<?php echo $o['id']?>">Update</a></td>
            <td><a href="delete1.php?id=<?php echo $o['id']?>&&table=odgovor">Delete</a></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<div class="col-lg-4 col-lg-offset-4" id="forma">
    <form method="post" action="admin.php?page=odgovori">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
        </div>
        <div class="form-group">
            <select name="pitanje">
                <?php foreach($pitanje as $p):?>
                    <option value="<?php echo $p['id'];?>"><?php echo $p['tekst_pitanja'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add</button>
    </form>
</div>
<script src="../js/jquery.min.js"></script>
<script>
    $('.users').click(function(event){
        event.preventDefault();
        var that=$(this);
        var table=that.data('table');
        var id=that.data('id');

        $.ajax({
            url:'get.php',
            method:'post',
            dataType:'JSON',
            data:{
                id:id,
                table:table
            },
            success:function(data){
                var forma = ""
                $.each(data,function(index,d){
                    forma += `<form method="post" action="odgovorEdit.php">
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="hidden" value="${d.id}" name="id">
        <input name="name" value="${d.tekst_odgovora}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
    </div>

    <button type="submit" name="Edit" class="btn btn-primary">Edit</button>
</form>`;
                });
                $('#forma').html(forma);
            }

        });
    });
</script>