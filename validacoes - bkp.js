function validateForm() {
 // Verifique se todos os campos obrigatórios estão preenchidos
 const camposObrigatorios = ["nome", "email", "telefone", "cargo", "escolaridade"];
 for (const campo of camposObrigatorios) {
 if (document.getElementById(campo).value === "") {
  alert(`O campo "${campo}" é obrigatório.`);
  return false;
 }
 }

 // Verifique se o número de telefone está no formato correto
 const telefone = document.getElementById("telefone").value;
 if (!telefone.match(/^\(?[0-9]{2}\)?[-. ]?[0-9]{4}[-. ]?[0-9]{4}$/)) {
 alert("O número de telefone deve estar no formato (xx)xxxxx-xxxx.");
 return false;
 }

 // Verifique se o arquivo é do tipo correto
 const arquivo = document.getElementById("arquivo").files[0];
 if (!arquivo) {
 alert("Por favor, selecione um arquivo.");
 return false;
 } else if (!["doc", "docx", "pdf"].includes(arquivo.type.split("/")[1])) {
 alert("Somente arquivos DOC, DOCX e PDF são aceitos.");
 return false;
 }

 // Verifique se o tamanho do arquivo é menor ou igual a 1 MB
 const tamanhoArquivo = arquivo.size / 1024 / 1024;
 if (tamanhoArquivo > 1) {
 alert("O tamanho do arquivo deve ser menor ou igual a 1 MB.");
 return false;
 }

 return true;
}
