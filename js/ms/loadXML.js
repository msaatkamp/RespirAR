	xmlDOM = "";
	readXml=null;
	 
		
		$(document).ready(function(){
			updateValorFrete();
		});
		
		function indexDi(di){
			var data = JSON.parse(localStorage.saveData || null) || [];
			var encontrado = false;
			for(t=0;t<data.length;t++){
				//saveData.length
				// console.log("T: "+t);
				// console.log("Pesquisado: "+ di +" Encontrado: "+ saveData[t].numeroDi);
				if(data[t].numeroDi==di){
					// console.log("Encontrado na posição: "+t);
					encontrado = true;
				}
			}
			if(!encontrado){
				// console.log("Não encontrado até a posição: "+t);			
			}
			return encontrado;
		}
		
		function overwriteDi(di){
			// console.log("SaveData Antes: "+saveData.length+" DI: "+ di);
			saveData = saveData.filter(function(item){
				return item.numeroDi !== di;
			});
			// console.log("SaveData Depois: "+saveData.length);
			add(objeto);
			// console.log("Não encontrado até a posição: "+t);			
		}
		
		function validateDeclaracao(declaracao){
			var valores = [
				"viaTransporteNome",
				"freteTotalReais",
				"numeroDI",
				"dataDesembaraco",
				"cargaDataChegada"
			]		
			
			valido = true;
			ausentes = [];
			for(i=0;i<valores.length;i++){
				if(!declaracao.hasOwnProperty(valores[i])){
					valido = false;
					ausentes.push(valores[i]);
				}
			}
			
			if(!valido){
				/*if(declaracao.hasOwnProperty("numeroDI")){
					alert("Declaração inválida \r\nNumeroDI: "+declaracao.numeroDI["#text"]+" \r\nValores Ausentes: \r\n" + ausentes);	
				}*/
				if(ausentes.includes("dataDesembaraco")&&!(ausentes.includes("numeroDI"))){
					console.log("Ausentes: "+ausentes);
					valido = true;
				}
				console.log("Declaração não validada:");
				console.log(declaracao);
			}
			
			
			return valido;
		}
		
		function removeDuplicates(originalArray, prop) {
			 var newArray = [];
			 var lookupObject  = {};

			 for(var i in originalArray) {
				lookupObject[originalArray[i][prop]] = originalArray[i];
			 }

			 for(i in lookupObject) {
				 newArray.push(lookupObject[i]);
			 }
			  return newArray;
		 }
		
		/*** Exemplo:
		var uniqueArray = removeDuplicates(arrayWithDuplicates, "licenseNum");
		console.log("uniqueArray is: " + JSON.stringify(uniqueArray));
		****/
	 
       $('#xmlForm').submit(function(event) {
			// console.log("Submitted");
           event.preventDefault();
           var selectedFile = document.getElementById('upload').files[0];
		   
		   //
           // <!-- console.log(selectedFile); -->
           var reader = new FileReader();
           reader.onload = function(e) {
               readXml=e.target.result;
               // console.log(readXml);
               var parser = new DOMParser();
               var doc = parser.parseFromString(readXml, "application/xml");
               // console.log(doc);
			   obj = xmlToJson(doc);
				// console.log(obj);
				
				count = 0;
				countTotal = obj["ListaDeclaracoes"].declaracaoImportacao.length;
				// console.log("Count Total: "+countTotal);				
				if(countTotal==undefined){					
					// console.log("é indefinido ê");
					
					if(!validateDeclaracao(obj["ListaDeclaracoes"].declaracaoImportacao)){
					}else{						
						i = 0;
						j = obj["ListaDeclaracoes"].declaracaoImportacao.adicao.length;
						objeto = { dados: []};
						var declaracao = obj["ListaDeclaracoes"].declaracaoImportacao
						objeto.viaTransporteNome = declaracao.viaTransporteNome["#text"] || "";
						objeto.freteTotalReais = declaracao.freteTotalReais["#text"] || "";
						objeto.numeroDi = declaracao.numeroDI["#text"] || "";
						if(declaracao.hasOwnProperty("dataDesembaraco")){
							objeto.dataDesembaraco = declaracao.dataDesembaraco["#text"];
						}else{
							objeto.dataDesembaraco = declaracao.dataRegistro["#text"]+15;
						}
						objeto.dataChegada = declaracao.cargaDataChegada["#text"] || "";
						
							while(i<j){	
								newObj = {
									"paisOrigemMercadoria": "",
									"paisOrigemCodigo": ""
								};
								if(declaracao.adicao[i].numeroDi == declaracao.numeroDi) {
									newObj["paisOrigemMercadoria"] = declaracao.adicao[i].paisOrigemMercadoriaNome["#text"] || "";
									// console.log(declaracao.adicao[i].paisOrigemMercadoriaNome["#text"]);
									
									newObj["paisOrigemCodigo"] = declaracao.adicao[i].paisOrigemMercadoriaCodigo["#text"] || "";
									// console.log(declaracao.adicao[i].paisOrigemMercadoriaCodigo["#text"]);
									
									// console.log(newObj);
									objeto.dados.push(newObj);
								}
								i++;
							}				
							
							
							if(indexDi(objeto.numeroDi)){
								var r = true; //confirm("numeroDI "+objeto.numeroDi+" já carregado, gostaria de sobrescrever?");
								if (r == true) {
								  overwriteDi(objeto.numeroDi);
								} 
							
							}else{
								add(objeto);
							}
					}
				}else{
					
					while(count<countTotal){					
					// if(obj["ListaDeclaracoes"].declaracaoImportacao[count].has
					
					if(!validateDeclaracao(obj["ListaDeclaracoes"].declaracaoImportacao[count])){
						// console.log
							
					}else{
						i = 0;
						
						var declaracao = obj["ListaDeclaracoes"].declaracaoImportacao[count];
						j = declaracao.adicao.length;
						objeto = { dados: [] };
						// console.log("current count: "+count);
						objeto.viaTransporteNome = declaracao.viaTransporteNome["#text"] || "";
						objeto.freteTotalReais = declaracao.freteTotalReais["#text"] || "";
						objeto.numeroDi = declaracao.numeroDI["#text"] || "";
						
						if(declaracao.hasOwnProperty("dataDesembaraco")){
							objeto.dataDesembaraco = declaracao.dataDesembaraco["#text"];
						}else{
							objeto.dataDesembaraco = declaracao.dataRegistro["#text"]+15;
						}
						// objeto.dataDesembaraco = declaracao.dataDesembaraco["#text"] || "";
						objeto.dataChegada = declaracao.cargaDataChegada["#text"] || "";
						
							while(i<j){	
								newObj = {
									"paisOrigemMercadoria": "",
									"paisOrigemCodigo": ""
								};
								if(declaracao.adicao[i].numeroDi == declaracao.numeroDi) {
									newObj["paisOrigemMercadoria"] = declaracao.adicao[i].paisOrigemMercadoriaNome["#text"] || "";
									// console.log(declaracao.adicao[i].paisOrigemMercadoriaNome["#text"]);
									
									newObj["paisOrigemCodigo"] = declaracao.adicao[i].paisOrigemMercadoriaCodigo["#text"] || "";
									// console.log(declaracao.adicao[i].paisOrigemMercadoriaCodigo["#text"]);
									
									// console.log(newObj);
									objeto.dados.push(newObj);
								}
								i++;
							}				
							// console.log("OK");
							
							if(indexDi(objeto.numeroDi)){
								var r = true; //confirm("numeroDI "+objeto.numeroDi+" já carregado, gostaria de sobrescrever?");
								if (r == true) {
								  overwriteDi(objeto.numeroDi);
								} 
							
							}else{
								add(objeto);
							}
						}
						count++;
					}
				}				
				updateValorFrete();				   
				//$("#upload").val("");
           }
           reader.readAsText(selectedFile);
		   
		   // xmlDOM = new DOMParser().parseFromString(readXml.toString(), 'text/xml'); 
		   // console.log(xmlDOM);
			if(1==1){
				console.log(saveData);
			}
       });
	   
	   
	   
	   
	   