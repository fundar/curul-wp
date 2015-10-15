	var data = {}
	
	data.temas = [
		{
			'tema': 'Financiamientos de Organismos Financieros Internacionales',
			'texto': 'Transparentar préstamos recibidos de organismos financieros internacionales', 
			'comisiones': [
				{
					'nombre': 'Hacienda y Crédito Público',
					'presidente': { 'nombre': 'Gina Cruz Blackledge', 'twitter': '@diputadospan' }
				}
			]
		},
		{
			'tema': 'Salud sexual y reproductiva en adolescentes',
			'texto': 'Etiquetar recursos necesarios para salud sexual y reproductiva en adolescentes', 
			'comisiones': [
				{
					'nombre': 'Salud',
					'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
				}
			]
		},
		{
			'tema': 'Salud materna',
			'texto': 'Asegurar recursos para reducir la mortalidad materna', 
			'comisiones': [
				{
					'nombre': 'Salud',
					'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
				}
			]
		},
		{
			'tema': 'Seguro Popular',
			'texto': 'No a los recortes en el Ramo 12: Salud', 
			'comisiones': [
				{
					'nombre': 'Salud',
					'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
				}
			]
		},
		{
			'tema': 'Mujeres con VIH',
			'texto': 'Transparentar y desglosar el presupuesto para VIH', 
			'comisiones': [
				{
					'nombre': 'Salud',
					'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
				}
			]
		},
		{
			'tema': 'Planificación Familiar',
			'texto': 'Transparencia en las compras consolidadas de anticonceptivos', 
			'comisiones': [
				{
					'nombre': 'Salud',
					'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
				}
			]
		},
		/*
		{
			'tema': 'Mecanismo transnacional e investigación de delitos contra migrantes',
			'texto': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ei', 
			'comisiones': [
				{
					'nombre': 'Asuntos Migratorios',
					'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES'	 }
				}
			]
		},
		*/
		{
			'tema': 'Niñez migrantes',
			'texto': 'No a la disminución de los recursos para atención a la infancia', 
			'comisiones': [
				{
					'nombre': 'Asuntos Migratorios',
					'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES' }
				}
			]
		},
		{
			'tema': 'Asilo y refugio ',
			'texto': 'Ampliar el presupuesto para los refugios y asilos en México', 
			'comisiones': [
				{
					'nombre': 'Asuntos Migratorios',
					'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES' }
				}
			]
		},
		{
			'tema': 'Valor al campesino',
			'texto': 'Exigimos un presupuesto más justo para el campo mexicano', 
			'comisiones': [
				{
					'nombre': 'Desarrollo Rural',
					'presidente': { 'nombre': 'José Erandi Bermúdez Méndez', 'twitter': '@erandibermudez' }
				},
				{
					'nombre': 'Agricultura y Riego',
					'presidente': { 'nombre': 'Germán Escobar Manjarrez', 'twitter': '@germanescobarmx' }
				}
			]
		},
		{
			'tema': 'Gasto excesivo en publicidad oficial',
			'texto': 'Regular #publicidadoficial y tope de 10% al sobrejercicio del gasto', 
			'comisiones': [
				{
					'nombre': 'Gobernación',
					'presidente': { 'nombre': 'Mercedes Del Carmen Guillén Vicente', 'twitter': '@PalomaGuillen' }
				}
			]
		},
		{
			'tema': 'Radios comunitarias',
			'texto': 'Cumplir con 1% para radios comunitarias y definir responsable de asignación', 
			'comisiones': [
				{
					'nombre': 'Comunicaciones',
					'presidente': { 'nombre': 'Ivonne Aracely Ortega Pacheco', 'twitter': '@ivonneop' }
				},
				{
					'nombre': 'Radio y Televisión',
					'presidente': { 'nombre': 'Lía Limón García', 'twitter': '@lialimo' }
				}
			]
		},
		{
			'tema': 'Fideicomisos y fondos',
			'texto': 'Mayor transparencia y claridad en los fideicomisos públicos', 
			'comisiones': [
				{
					'nombre': 'Hacienda y Crédito Público',
					'presidente': { 'nombre': 'Gina Cruz Blackledge', 'twitter': '@diputadospan' }
				}
			]
		},
		/*
		{
			'tema': 'Presupuesto para capacitación de operadores en derechos humanos y de mujeres',
			'texto': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ei', 
			'comisiones': [
				{
					'nombre': 'Igualdad de género',
					'presidente': { 'nombre': 'Laura Nereida Plascencia Pacheco', 'twitter': '@LNPlascencia' }
				}
			]
		},
		*/
		{
			'tema': 'Implementación de reforma del Sistema de Justicia Penal',
			'texto': 'Justificar el ejercicio de los recursos del nuevo sistema de justicia penal', 
			'comisiones': [
				{
					'nombre': 'Justicia',
					'presidente': { 'nombre': 'Álvaro Ibarra Hinojosa', 'twitter': '@DiputadosPRI' }
				}
			]
		}
	];

	data.diputados = {
		'presidente':  {'nombre': 'Baltazar Hinojosa Ochoa', 'twitter': '@BaltazarxTam' },
		'bancadas': [
				{ 
					'nombre': 'PRI',
					'presidente': { 'nombre': 'César Octavio Camacho Quiroz',	'twitter': '@ccq_pri' }
				},
				{ 
					'nombre': 'PAN',
					'presidente': { 'nombre': 'Marko Antonio Cortés Mendoza',	'twitter': '@markocortes' }
				},
				{ 
					'nombre': 'PRD',
					'presidente': { 'nombre': 'Francisco Martinez Neri',	'twitter': '@fmartinezneri' }
				},
				{ 
					'nombre': 'PVEM',
					'presidente': { 'nombre': 'Jesús Sesma Suárez',	'twitter': '@chuchosesma' }
				},
				{ 
					'nombre': 'MORENA',
					'presidente': { 'nombre': 'Norma Rocío Nahle García',	'twitter': '@rocionahle' }
				},
				{ 
					'nombre': 'MOVIMIENTO CIUDADANO',
					'presidente': { 'nombre': 'José Clemente Castañeda Hoeflich',	'twitter': '@clementech' }
				},
				{ 
					'nombre': 'NUEVA ALIANZA',
					'presidente': { 'nombre': 'Luis Alfredo Valles Mendoza',	'twitter': '@alfredvalles' }
				},
				{ 
					'nombre': 'ENCUENTRO SOCIAL',
					'presidente': { 'nombre': 'Alejandro González Murillo',	'twitter': '@AlejandroGonMu' }
				},
				{ 
					'nombre': 'ENCUENTRO SOCIAL',
					'presidente': { 'nombre': 'Alejandro González Murillo',	'twitter': '@AlejandroGonMu' },
				}
		] 
	};

	var CreateTweet = function(diputados, tema, hashtag){
		this.diputados = diputados;
		this.tema = tema;
		this.hashtag = hashtag;
	}

	CreateTweet.prototype.diputado_aleatorio = function(grupo){
		var getRandom = function (min, max) {
  		return parseInt( Math.random() * (max - min) + min ); 
		}
		var max = grupo.length - 1;
		return grupo[ getRandom(0, max) ] 
	}

	CreateTweet.prototype.get_rep_twitters = function(){
		var twitters = [];
		twitters.push(this.diputados.presidente.twitter);
		twitters.push(this.diputado_aleatorio(this.diputados.comisiones).presidente.twitter);
		//twitters.push(this.diputado_aleatorio(this.diputados.bancadas).presidente.twitter);

		return twitters.join(" ");
	}

	CreateTweet.prototype.run = function(){
		this.diputados.comisiones = this.tema.comisiones
		this.text = [ this.tema.texto, this.hashtag ].join(' ')
		this.tweet = [ this.tema.texto, this.get_rep_twitters(), this.hashtag ].join(' ')

		this.el = $("<a class='twitter-share-button' data-size='large' data-count='none'></a>")
		this.el.attr( "href", "https://twitter.com/intent/tweet?text=" + encodeURI(this.tweet) )

		return { 'el': this.el, 'text': this.text, 'tweet': this.tweet } ;
	}


	