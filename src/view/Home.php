<?php include __DIR__ . '/../utils/inicioHtml.php'; ?>

<div class="cadastro text-right">
  <button id='btnCadastro' class="btn btn-primary mb-2"> Novo Usuario </button>
</div>
<div class="listaUsuarios">
  <table class="table" id="tabelaUsuarios" border="1">
    <thead>
      <tr>
        <th>Ordem</th>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>Cpf</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<div class="atualizar text-center">
  <button id='btnAtualizar' class="btn btn-primary mb-2"> Atualizar Lista </button>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      var url = "/home/?action=buscarUsuarios";
      $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json'
      })
      .done(function(dados){
          montarGrid(dados)
      })
      .fail(function(){
          alert("Não foi possivel recuperar os usuarios")
      })

      $("#btnAtualizar").on("click", function(){
        console.log("Atualizar lista")
      })
  })

  function montarGrid(usuarios){
    var ordem = 0
    usuarios.forEach(usuario => {
      var linha = `<tr>
        <td align='center'> ${++ordem} </td>
        <td> ${usuario.nome} </td>
        <td> ${usuario.sobrenome} </td>
        <td align='center'> ${usuario.cpf} </td>
      ` 
      $("#tabelaUsuarios tbody").append(linha)

    });
  }

</script>   

<?php include __DIR__ . '/../utils/fimHtml.php'; ?>