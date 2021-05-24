//**************************************************************************//
// Funciones JAVASCRIPT para el Sistema de Impuestos (Municipio Guasimos)   //
//                                                                          //
//                                                                          //
//                                                                          //
//                                                                          //
//                                                                          // 
//                                                                          //  
//                                                                          //    
//**************************************************************************//            

function SoloNumeros(evt) // solo permite insertar NUMEROS,EL PUNTO, ENTER, ESPACIO
{
	var nav4 = window.Event ? true : false;
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57, '.' = 46
	var key = nav4 ? evt.which : evt.keyCode;
	return (key <= 13 || (key >= 48 && key <= 57) || key == 46 || key == 45);
}
function Sololetras(evt)  //solp permite ingressar LETRAR, EL PUNTO, ENTER,ESPACIO
{
	var nav4 = window.Event ? true : false;
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57, '.' = 46
	var key = nav4 ? evt.which : evt.keyCode;
	return (key <= 13 || key == 32 ||(key >= 65 && key <= 90) || key == 44);
}









// JavaScript Document