
const validar = (cpf) => checkAll(prepare(cpf));

const notDig = (i) => ![".", "-", " "].includes(i);
const prepare = (cpf) => cpf.trim().split("").filter(notDig).map(Number);
const is11Len = (cpf) => cpf.length === 11;
const notAllEquals = (cpf) => !cpf.every((i) => cpf[0] === i);
const onlyNum = (cpf) => cpf.every((i) => !isNaN(i));

const calcDig = (limit) => (a, i, idx) => a + i * (limit + 1 - idx);
const somaDig = (cpf, limit) => cpf.slice(0, limit).reduce(calcDig(limit), 0);
const resto11 = (somaDig) => 11 - (somaDig % 11);
const zero1011 = (resto11) => ([10, 11].includes(resto11) ? 0 : resto11);

const getDV = (cpf, limit) => zero1011(resto11(somaDig(cpf, limit)));
const verDig = (pos) => (cpf) => getDV(cpf, pos) === cpf[pos];

const checks = [is11Len, notAllEquals, onlyNum, verDig(9), verDig(10)];
const checkAll = (cpf) => checks.map((f) => f(cpf)).every((r) => !!r);







Vue.component('linkcontato', {
	//props: ['theme'],
	template: `
		<a href="javascript:;" v-on:click="openModal"><slot></slot></a>
	`,
	data() {
		return {
			show: false 
		};
	},
	methods: {
		openModal: function () {
			vueContato.openModal();
		},
	}
});







// MASK
var tokens = {
	'#': {pattern: /\d/},
	'S': {pattern: /[a-zA-Z]/},
	'A': {pattern: /[0-9a-zA-Z]/},
	'U': {pattern: /[a-zA-Z]/, transform: v => v.toLocaleUpperCase()},
	'L': {pattern: /[a-zA-Z]/, transform: v => v.toLocaleLowerCase()}
}

function applyMask (value, mask, masked = true) {
  value = value || ""
  var iMask = 0
  var iValue = 0
  var output = ''
  while (iMask < mask.length && iValue < value.length) {
    cMask = mask[iMask]
    masker = tokens[cMask]
    cValue = value[iValue]
    if (masker) {
      if (masker.pattern.test(cValue)) {
      	output += masker.transform ? masker.transform(cValue) : cValue
        iMask++
      }
      iValue++
    } else {
      if (masked) output += cMask
      if (cValue === cMask) iValue++
      iMask++
    }
  }
  return output
}


Vue.directive('mask', {
	bind (el, binding) {
    let value = el.value
    Object.defineProperty(el, 'value', {
        get: function(){
            return value;
        },
        set: function(newValue){
			el.setAttribute('value', newValue)
        },
        configurable: true
    });
  }
});


//Vue.directive('click-outside', {
	//bind () {
		//this.event = event => this.vm.$emit(this.expression, event)
		//this.el.addEventListener('click', this.stopProp)
		//document.body.addEventListener('click', this.event);
		//console.log('bind');
	//},   
	//unbind() {
		//this.el.removeEventListener('click', this.stopProp)
		//document.body.removeEventListener('click', this.event);
		//console.log('unbind');
	//},
	//stopProp(event) { event.stopPropagation() }
//})

//Vue.directive('out', {

    //bind: function (el, binding, vNode) {
        //const handler = (e) => {
            //if (!el.contains(e.target) && el !== e.target) {
                ////and here is you toggle var. thats it
                //vNode.context[binding.expression] = false
            //}
        //}
        //el.out = handler
        //document.addEventListener('click', handler)
    //},

    //unbind: function (el, binding) {
        //document.removeEventListener('click', el.out)
        //el.out = null
    //}
//})


Vue.component('click-outside', {
  created: function () {
	document.body.addEventListener('click', (e) => {
		if (!this.$el.contains(e.target)) {
			console.log('teste');
			//vue.openBoxTipoEmpresa.active = false;
			this.$emit('clickOutside');
		}
	})
  },
  template: `
	<div><slot></slot></div>
`
});



Vue.component('input-mask', {
	template: `<input v-model="maskedValue" :maxlength="mask.length" :placeholder="mask" :name="maskedName" :id="maskedName" autocomplete="off" />`,
	props: {
		'value': String,
		'mask': String,
		'masked': {
			type: Boolean,
			default: true
		}
	},

	data: () => ({
		currentValue: '',
		currentMask: '',
	}),

  computed: {
	maskedName: {
		get () {}
	},
    maskedValue: {
    	get () {
        // fix removing mask character at the end.
        // Pressing backspace after 1.2.3 result in 1.2. instead of 1.2
		//console.log( 'currentValue'+  this.currentValue );
		//console.log( 'currentMask'+  this.currentMask );
		//return this.value = this.currentMask;
        return this.value === this.currentValue ? this.currentMask : (this.currentMask = applyMask(this.value, this.mask, true))
      },

      set (newValue) {
        var currentPosition = this.$el.selectionEnd
        var lastMask = this.currentMask
        // update the input before restoring the cursor position
        this.$el.value = this.currentMask = applyMask(newValue, this.mask)

        if (this.currentMask.length <= lastMask.length) { // BACKSPACE
          // when chars are removed, the cursor position is already right
          this.$el.setSelectionRange(currentPosition, currentPosition)
        } else { // inserting characters
          // if the substring till the cursor position is the same, don't change position
          if (newValue.substring(0, currentPosition) == this.currentMask.substring(0, currentPosition)) {
            this.$el.setSelectionRange(currentPosition, currentPosition)
          } else { // increment 1 fixed position, but will not work if the mask has 2+ placeholders, like: ##//##
            this.$el.setSelectionRange(currentPosition+1, currentPosition+1)
          }
        }
        this.currentValue = applyMask(newValue, this.mask, this.masked)
        this.$emit('input', this.currentValue)
      }
    }
  }
});



// Função para gerar hash MD5
function md5(str) {
    // Função auxiliar para converter um número para uma string de dois dígitos
    function toHexString(num) {
        var hex = num.toString(16);
        return hex.length === 1 ? '0' + hex : hex;
    }

    // Inicializa os buffers
    var i, j, k;
    var MD5hash = new Array(4);

    // Converte a string para uma matriz de bytes
    var byteMessage = [];
    for (i = 0; i < str.length; i++) {
        byteMessage.push(str.charCodeAt(i) & 0xff);
    }

    // Adiciona o padding
    byteMessage.push(0x80);
    while (byteMessage.length % 64 !== 56) {
        byteMessage.push(0x00);
    }

    // Adiciona o comprimento original da mensagem (em bits)
    byteMessage.push(str.length * 8 & 0xffffffff);
    byteMessage.push(Math.floor(str.length * 8 / 0x100000000));

    // Função auxiliar para rodar um número
    function rotateLeft(lValue, iShiftBits) {
        return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
    }

    // Constantes do MD5
    var s11 = 7,
        s12 = 12,
        s13 = 17,
        s14 = 22;
    var s21 = 5,
        s22 = 9,
        s23 = 14,
        s24 = 20;
    var s31 = 4,
        s32 = 11,
        s33 = 16,
        s34 = 23;
    var s41 = 6,
        s42 = 10,
        s43 = 15,
        s44 = 21;

    // Inicializa os buffers
    var a = 0x67452301,
        b = 0xefcdab89,
        c = 0x98badcfe,
        d = 0x10325476;

    // Funções auxiliares do MD5
    function ff(a, b, c, d, x, s, ac) {
        a += (b & c | ~b & d) + x + ac;
        a = rotateLeft(a, s);
        return a + b & 0xffffffff;
    }

    function gg(a, b, c, d, x, s, ac) {
        a += (b & d | c & ~d) + x + ac;
        a = rotateLeft(a, s);
        return a + b & 0xffffffff;
    }

    function hh(a, b, c, d, x, s, ac) {
        a += (b ^ c ^ d) + x + ac;
        a = rotateLeft(a, s);
        return a + b & 0xffffffff;
    }

    function ii(a, b, c, d, x, s, ac) {
        a += (c ^ (b | ~d)) + x + ac;
        a = rotateLeft(a, s);
        return a + b & 0xffffffff;
    }

    // Processamento por bloco de 512 bits
    for (i = 0; i < byteMessage.length; i += 64) {
        var aA = a,
            bB = b,
            cC = c,
            dD = d;
        for (j = 0, k = i; j < 64; j += 4, k++) {
            var strByte = byteMessage[k];
            strByte += byteMessage[k + 1] << 8;
            strByte += byteMessage[k + 2] << 16;
            strByte += byteMessage[k + 3] << 24;

            var T = Math.floor(Math.abs(Math.sin(j + 1)) * 0x100000000);
            var X = strByte;
            var rolA = 0;
            var f = 0;

            switch (Math.floor(j / 16)) {
                case 0:
                    f = ff(a, b, c, d, X, s11, T);
                    a = d;
                    d = c;
                    c = b;
                    b = f;
                    break;
                case 1:
                    f = gg(a, b, c, d, X, s21, T);
                    a = d;
                    d = c;
                    c = b;
                    b = f;
                    break;
                case 2:
                    f = hh(a, b, c, d, X, s31, T);
                    a = d;
                    d = c;
                    c = b;
                    b = f;
                    break;
                case 3:
                    f = ii(a, b, c, d, X, s41, T);
                    a = d;
                    d = c;
                    c = b;
                    b = f;
                    break;
            }
        }

        a = (a + aA) & 0xffffffff;
        b = (b + bB) & 0xffffffff;
        c = (c + cC) & 0xffffffff;
        d = (d + dD) & 0xffffffff;
    }

    // Converte os buffers para uma string hexadecimal
    return toHexString(a) + toHexString(b) + toHexString(c) + toHexString(d);
}

// Função para gerar o hash MD5 no formato especificado
function generateMD5Hash() {
    // Gera a data atual no formato "Y-m-d H:i:s"
    const timestamp = new Date().toISOString().slice(0, 19).replace('T', ' ');

    // Gera uma string aleatória alfanumérica de comprimento 16
    function randomString(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    // Gera uma string aleatória de 16 caracteres alfanuméricos
    const randomStr = randomString(16);

    // Concatena a data e a string aleatória
    const hashString = timestamp + "" + randomStr;

    // Calcula o hash MD5 da string	
    //const hash = md5(hashString);
	const hash = CryptoJS.MD5(hashString);

    return hash;
}


function fctRandomString(length) {
	var result = '';
	var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var charactersLength = characters.length;
	for (var i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}

// Exemplo de uso
//const grp_hashkey = generateMD5Hash();
//console.log(grp_hashkey);


