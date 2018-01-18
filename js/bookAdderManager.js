
function changenumofAuthor(event)
{
  var num = event.target.value;
  var authorholder = document.getElementById('authorNames');
  var form = "<input type='text' placeholder='Last, First M.I.' name='name[]'><br>"
  var formout = "";
  for(var i=0; i<num; i++)
  {
    formout += form;
  }
  authorholder.innerHTML = formout;
}

function toggleDiv(targetDiv, event)
{
  var fetch = event.target.value;
  document.getElementById(targetDiv).innerHTML = fetch;
  if(fetch =='true')
    document.getElementById(targetDiv).show();
  else
    document.getElementById(targetDiv).hide();
}
