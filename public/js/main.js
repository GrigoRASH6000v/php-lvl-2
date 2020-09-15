
class Shop {
    constructor(){
        this.buttons = [...document.querySelectorAll('button')]
        this.values = [...document.querySelectorAll('input')]
        this.valuesSumm = [...document.querySelectorAll('.cart_good_quantitySumm')]
        this.goodsCart = [...document.querySelectorAll('.cart_good')]
        this.goodsCatalog = [...document.querySelectorAll('.catalog-item')]
        this.form = document.querySelector('#formCreate');
        this.formEdit = document.querySelector('#formEdit')
        this.formEdit ? this.autoWidthFunction(this.formEdit) : ""
        
        
    } 
    autoWidthFunction(form){
        let formArr = [...form]
        for(let i=0; i<=formArr.length-3; i++){
            formArr[i].style.width=`${(formArr[i].value.length + 1) * 10}px`
        }
    }
    query(url){
        return fetch(url, {
            method: 'GET',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
        }).then(r => r.text())
    }
    postData(url, data){
        return fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.text())
    }
    findElement(arr, val){
        let result=null
        arr.forEach(el=>el.dataset.id==val ?  result = el : "")
        return result
    }

    listenersInit(){
        this.buttons.forEach(el => {
            el.addEventListener('click', (evt)=>{
                let target = evt.target.dataset.name
                target=="add" ? this.addToCart(evt.target.dataset.id) : ""
                target=="remove" ? this.removeFromCart(evt.target.dataset.id) : ""
                target=="less" ? this.lessQuantity(evt.target.dataset.id) : ""
                target=="more" ? this.moreQuantity(evt.target.dataset.id) : ""
                target=="removeCat" ? this.removeFromCatalog(evt.target.dataset.id) : ""
                //target=="saveChange" ? this.saveChange(evt.target.dataset.id) : ""
                //saveChange
            })
        });
        if(this.form){
            this.form.addEventListener('submit', (evt)=>{
                evt.preventDefault()
                this.addToCatalog()
            })
        }
        if(this.formEdit){
            let formArr = [...this.formEdit]
            for(let i=0; i<=formArr.length-3; i++){
                formArr[i].addEventListener('keydown', ()=>this.autoWidthFunction(this.formEdit))
            }
            this.formEdit.addEventListener('submit', (evt)=>{
                evt.preventDefault()
                this.saveChange(evt.target.dataset.id)
            })
        }
        
    }
    validationFields(){

    }
    colorizationField(fields){
        [...this.form].forEach(el=>{
            fields.find(item=>item==el.name) ? el.classList.add('novalid') : ""
        })
    }
    checkFields(){
        let fieldsForm = $('#formCreate').serializeArray()
        let noValid = [];
        fieldsForm.forEach(el=>{
            if(!el.value){
                noValid.push(el.name)
            }
        })
        return noValid
    }
    saveChange(){
        let formData = new FormData(this.formEdit);
        
        this.postData("index.php?path=admin/saveChange", formData ).then(data => {
            alert(JSON.parse(data).content_data)
            //console.log(data)
        })

    }
    addToCatalog(){
        
        if(this.checkFields().length){
            this.colorizationField(this.checkFields())
            alert("Некоторые поля формы не заполнены")
        }else{
            this.colorizationField(this.checkFields())
            let formData = new FormData(this.form);
            this.postData("index.php?path=admin/addGood", formData ).then(data => {
                alert(JSON.parse(data).content_data)
                
            }).then(()=>{
                [...this.form].forEach(el=>{
                    el.classList.remove('novalid')
                    el.value=""
                })
            })
        }
    }
    addToCart(id){
        this.query("index.php?path=catalog/check/"+id).then(d=>
            JSON.parse(d).content_data.length ? this.moreQuantity(id) : this.query("index.php?path=catalog/add/"+id)
        )
    
    }
    removeFromCart(id){
        let res = this.findElement(this.goodsCart, id);
        this.query("index.php?path=basket/remove/"+id).then(()=>{
            res.remove()
        })
    }
    removeFromCatalog(id){
       
        let res = this.findElement(this.goodsCatalog, id);
        console.log(res)
        this.query("index.php?path=admin/removeGood/"+id).then((d)=>{
            res.remove()
        })
        //res.remove()
    }
    lessQuantity(id){
        let res = this.findElement(this.values, id);
        let sum = this.findElement(this.valuesSumm, id)
        if(res.value>1){
            this.query("index.php?path=basket/less/"+id).then(d=>{
                res.value = JSON.parse(d).content_data[0].quantity
                sum.innerText = JSON.parse(d).content_data[0].price * JSON.parse(d).content_data[0].quantity
            })
        }
    }
    moreQuantity(id){
        let res = this.findElement(this.values, id)
        let sum = this.findElement(this.valuesSumm, id)
        this.query("index.php?path=basket/more/"+id).then(d=>{
            res ? res.value = JSON.parse(d).content_data[0].quantity : ""
            sum ? sum.innerText = JSON.parse(d).content_data[0].price * JSON.parse(d).content_data[0].quantity : ""
        })
    }
}

class Autorization {
    constructor(container){
        this.container = document.querySelector(container)
        this.formAuth = this.container.querySelector('#autorization_form')
        this.formRegister = this.container.querySelector('#registration_form')
        this.formAuth ? this.initListeners(this.formAuth) : this.initListeners(this.formRegister)
        //this.formAuth ? console.log(this.formAuth) : console.log(this.formRegister)
    }
    
    initListeners(form){
       form.addEventListener('submit', (e)=>{
           e.preventDefault()
           e.target.id=="registration_form" ? this.registrationUser(form) : ""
       })
    }
    postData(url, data){
        return fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.text())
    }
    registrationUser(fm){
        let formData = new FormData(fm);
        this.postData("index.php?path=autorization/regNewUser", formData ).then(data => {
            console.log(data)
        })  
        // }).then(()=>{
        //     [...this.form].forEach(el=>{
        //         el.classList.remove('novalid')
        //         el.value=""
        //     })
        // })
    }
}

$(document).ready(function(){
   
    //    let show = false;
    //    $('#cart-btn').on('click', function(){
    //        show=!show;
    //        show ? $('#cart').fadeIn(300, ()=>{$('#cart').css('display', 'grid')}) : $('#cart').fadeOut(300, ()=>{$('#cart').css('display', 'none')})
    //    })
    
    let shop = new Shop;
    shop.listenersInit()
    let formAutorizatio = new Autorization('.autorization')
    
});

