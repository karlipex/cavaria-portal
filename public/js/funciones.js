
function options(){
    document.getElementById("op").classList.add("ver-options");
    document.getElementById("sp").classList.add("animate");
    document.getElementById("sp").setAttribute("onclick", "cerrarop()");
}
function cerrarop(){
    document.getElementById("op").classList.remove("ver-options");
    document.getElementById("sp").classList.remove("animate");
    document.getElementById("sp").setAttribute("onclick", "options()");
}

function abre(){
  document.getElementById("newllamada").classList.add("abremodal");
}

function cerrarModal(){
    document.getElementById("newllamada").classList.remove("abremodal");
    document.getElementById("btn-comenzar").style.display="none";
}

function deleteCont(){
  document.getElementById("eliminarCont").classList.add("abremodal");
}

function cerrarCont(){
        document.getElementById("eliminarCont").classList.remove("abremodal");
}

function format(input)
{
        var num = input.value.replace(/\./g,'');
        if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
     }
      else{
      input.value = input.value.replace(/[^\d\.]*/g,'');
    }
 }

function opcionLlamada(){
	opcion= document.getElementById("opciones").value;
    switch(opcion){
      case "0":
       document.getElementById("status1").style.display="none";
       document.getElementById("status2").style.display="none";
       document.getElementById("status3").style.display="none";
      break;
      case "1":
       document.getElementById("status1").style.display="block";
       document.getElementById("status2").style.display="none";
       document.getElementById("status3").style.display="none";
      break;
      case "2":
       document.getElementById("status1").style.display="none";
       document.getElementById("status2").style.display="block";
       document.getElementById("status3").style.display="none";
      break;
      case "3":
       document.getElementById("status1").style.display="none";
       document.getElementById("status2").style.display="none";
       document.getElementById("status3").style.display="block";
      break;
    }
}

function status1(){
    status = document.getElementById("status1").value;
    if(status == "Contesta, pero llama después" || status == "Embarazada"){
        document.getElementById("fechanueva").style.display="block";
        document.getElementById("closecount").style.display="none";
    }else{
        document.getElementById("fechanueva").style.display="none";
        document.getElementById("closecount").style.display="block";
        document.getElementById("closecount").setAttribute("onclick","callDespues2()");
    }
}

function status3(){
   status = document.getElementById("status3").value;
   if(status == "Solicita no llamar de nuevo" || status == "Solo cotizando" || status == "Enfermedad autoinmune" || status == "Solo curiosidad" || status == "No tengo dinero" || status == "Ya se lo hizo" || status == "Ya lo llamaron" || status == "Número no corresponde" || status == "Pensó que la evaluación era gratis"){
     document.getElementById("otraCiudad").style.display="none";
     document.getElementById("fueraPresupuesto").style.display="none";
     document.getElementById("prestacionNo").style.display="none";
     document.getElementById("closecount").style.display="block";
     document.getElementById("closecount").setAttribute("onclick","noLlamarMas()");
   }
if(status == ""){
    document.getElementById("otraCiudad").style.display="none";
     document.getElementById("fueraPresupuesto").style.display="none";
     document.getElementById("prestacionNo").style.display="none";
     document.getElementById("closecount").style.display="none";
}
   if(status == "De otra ciudad" ){
     document.getElementById("otraCiudad").style.display="block";
     document.getElementById("fueraPresupuesto").style.display="none";
     document.getElementById("prestacionNo").style.display="none";
     document.getElementById("closecount").style.display="none";
   }
   if(status == "Fuera de presupuesto"){
     document.getElementById("fueraPresupuesto").style.display="block";
     document.getElementById("otraCiudad").style.display="none";
     document.getElementById("prestacionNo").style.display="none";
     document.getElementById("closecount").style.display="none";
   }
   if(status == "Prestación no existe"){
     document.getElementById("prestacionNo").style.display="block";
     document.getElementById("otraCiudad").style.display="none";
     document.getElementById("fueraPresupuesto").style.display="none";
     document.getElementById("closecount").style.display="none";
   }
}

function origen(){
  corigen = document.getElementById("corigen").value;
  if(corigen ==""){
    document.getElementById("asesor").style.display="none";
    document.getElementById("ingr").style.display="none";
  }
  if(corigen =="Contacto Pagina Web C.A."){
    document.getElementById("asesor").style.display="none";
    document.getElementById("ingr").style.display="block";
  }
  if(corigen =="Contacto Facebook"){
    document.getElementById("asesor").style.display="none";
    document.getElementById("ingr").style.display="block";
  }
   if(corigen =="Contacto Antiguo"){
    document.getElementById("asesor").style.display="block";
    document.getElementById("ingr").style.display="block";
  }
}
function story(){
    document.getElementById("historial").classList.add("abremodal");
}
function cierraStory(){
    document.getElementById("historial").classList.remove("abremodal");
}
function actButtonTime(){
    document.getElementById("newTime").style.display="block";
}
function actDate(){
  document.getElementById("inicio").style.display="inline";
}
function actButtonDate(){
  document.getElementById("fin").style.display="inline";
}
function actButtonCerrarNewDate(){
    document.getElementById("closecount").style.display="block";
    document.getElementById("closecount").setAttribute("onclick","callDespues1()");
}
function actButtonCerrarAgenda(){
    document.getElementById("closecount").style.display="block";
    document.getElementById("closecount").setAttribute("onclick","agenda()");
}
function actButtonCerrarOtraCiudad(){
    document.getElementById("closecount").style.display="block";
    document.getElementById("closecount").setAttribute("onclick","otraCiudadFun()");
}
function actButtonCerrarPresupuesto(){
    document.getElementById("closecount").style.display="block";
    document.getElementById("closecount").setAttribute("onclick","budget()");
}
function actButtonCerrarNP(){
    document.getElementById("closecount").style.display="block";
    document.getElementById("closecount").setAttribute("onclick","nopres()");
}
function getContactos1(){
  document.getElementById("infoContacto1").style.display="block";
}
function closeContactos1(){
  document.getElementById("infoContacto1").style.display="none";
}
function getContactos2(){
  document.getElementById("infoContactados1").style.display="block";
}
function closeContactos2(){
  document.getElementById("infoContactados1").style.display="none";
}
function getContactos3(){
  document.getElementById("infoagendados1").style.display="block";
}
function closeContactos3(){
  document.getElementById("infoagendados1").style.display="none";
}
function closeFiltro1(){
  document.getElementById("filtro1").style.display="none";

}
function closeFiltro2(){
  document.getElementById("filtro2").style.display="none";
}
function closeFiltro3(){
  document.getElementById("filtro3").style.display="none";
}
function csv(){
  document.getElementById("csv").classList.add("abremodal")
}
function closeCsv(){
  document.getElementById("csv").classList.remove("abremodal")
}