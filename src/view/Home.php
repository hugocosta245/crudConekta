<?php include __DIR__ . '/../utils/inicioHtml.php'; ?>

<!-- Modal ADD USER-->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="nome" class="form-control" id="inputNome" placeholder="Nome">
            <small id="nome" class="form-text text-muted">Seu nome</small>
          </div>
          <div class="form-group">
            <label for="inputSobreNome">Sobrenome</label>
            <input type="sobrenome" class="form-control" id="inputSobreNome"  placeholder="Sobrenome">
            <small id="sobrenome" class="form-text text-muted">Seu sobrenome.</small>
          </div>
          <div class="form-group">
            <label for="inputCPF">CPF</label>
            <input type="cpf" class="form-control" id="inputCPF"  placeholder="Seu CPF" onkeypress="$(this).mask('000.000.000-00');">
            <small id="cpf" class="form-text text-muted">Documento pessoa fisica CPF.</small>
          </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="addUsuario" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>

<div class="text-left">
  <span>Click na celula desejada para editar.</span>
</div>

<div class="cadastro text-right">
  <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#ExemploModalCentralizado"> Novo Usuario </button>
</div>
<div class="listaUsuarios">
  <table class="table" id="tabelaUsuarios" border="1">
    <thead>
      <tr>
        <th>Ordem</th>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>Cpf</th>
        <th>Ações</th>
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
        window.location.reload();
      })      
  })


$(document).on("dblclick", "td", function(){
        let conteudoOriginal = $(this).text();
        let nomeCelula = $(this).attr("name");
        let idUsuario = $(this).attr("idValue");

        $(this).addClass("celulaEmEdicao");
        if (nomeCelula == 'cpf') { 
          $(this).html("<input class='inputDocumento' type='text' value='" + conteudoOriginal + "' onkeypress='$(this).mask('000.000.000-00');'' />");
            $('.inputDocumento').mask('000.000.000-00');
        } else {
          $(this).html("<input type='text' value='" + conteudoOriginal + "' />");
          
        }
      
        $(this).children().first().focus();

        $(this).children().first().keypress(function (e) {
            if (e.which == 13) {
                var novoConteudo = $(this).val();
                editUser(nomeCelula, novoConteudo , idUsuario )
                $(this).parent().text(novoConteudo);
                $(this).parent().removeClass("celulaEmEdicao");

            }
        });

	      $(this).children().first().blur(function(){
	      	$(this).parent().text(conteudoOriginal);
	      	$(this).parent().removeClass("celulaEmEdicao");
	      });
 });  

  

  function editUser(nomeCelula, novoConteudo, idUsuario){    
    let url = "/home/?action=editaUsuarios";  
    
    $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: {id: idUsuario, valor: novoConteudo, campo: nomeCelula }  
      })
      .done(function(dados){

        if(dados.result === 'sucesso') {  
          //window.location.reload()
          $.notify(`Dados alterados usuario: ${dados.data.nome} ${dados.data.sobrenome} do CPF ${dados.data.cpf}`, "success");
          
        } else if(dados.result === 'erroInserir') {          
          $.notify("Não foi possivel alterar os dados !", "error");
        
        }
        
      })
  }
  function deleteUser(obj){  

    let url = "/home/?action=deleteUsuarios";

    $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: { idDelete: obj.value }
      })
      .done(function(dados){

        if(dados.result === 'sucesso') {  
          //window.location.reload()
          $.notify(`Usuario ${dados.data.nome} ${dados.data.sobrenome} do CPF ${dados.data.cpf} Foi DELETADO com Sucesso! `, "success");
          setTimeout(function() {
               window.location.reload(1);
          }, 7000); // 5 segundos
        } else if(dados.result === 'erroInserir') {          
          $.notify("Não foi possivel deletar os dados !", "error");
        
        }
        
      })
  }


  $("#addUsuario").click(function() {
    
    let valueInputNome      = $("#inputNome").val()
    let valueInputSobrenome = $("#inputSobreNome").val()
    let valueInputCPF       = $("#inputCPF").val()
    let url = "/home/?action=addUsuarios";
      $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: { name: valueInputNome , sobrenome: valueInputSobrenome, cpf: valueInputCPF }
      })
      .done(function(dados){
          
          if (dados.result === 'erro') {
            $(`#input${dados.campo}`).notify(
                  dados.messagem, 
                 { position:"bottom left" }
            );          
          } else if(dados.result === 'sucesso') {
  
            $('#ExemploModalCentralizado').modal('hide');
            $.notify("Dados Inseridos com sucesso !", "success");
            setTimeout(function() {
               window.location.reload(1);
            }, 7000); // 5 segundos


          } else if(dados.result === 'erroInserir') {

            $('#ExemploModalCentralizado').modal('hide');
            $.notify("Não foi possivel inserir os dados !", "error");

          }
        
      })
      .fail(function(dados){
         
          console.log("erroo",dados)
      })
  })


  function montarGrid(usuarios){
    let ordem = 0
    let linha = ''
    usuarios.forEach(usuario => {
       linha += `<tr>
        <th align='center'> ${++ordem} </th>
        <td name="name" idValue="${usuario.id}" >${usuario.nome}</td>
        <td name="sobrenome" idValue="${usuario.id}" > ${usuario.sobrenome} </td>
        <td class="documento" align='center' name="cpf" idValue="${usuario.id}"'> ${usuario.cpf} </td>
        <th class="acao">
            <button  class="btn btn-danger btn-sm rounded-0" type="button" id="deleteUsuario" data-toggle="tooltip" data-placement="top" title="Delete" value="${usuario.id}"  onClick="deleteUser(this)"><i class="fa fa-trash"></i></button>
        </td>
      `
    });

    $("#tabelaUsuarios tbody").append(linha)
    $('.documento').mask('000.000.000-00');
  }


</script>   

<?php include __DIR__ . '/../utils/fimHtml.php'; ?>