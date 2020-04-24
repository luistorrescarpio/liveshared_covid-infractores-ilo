<template>
	<div class="container-fluid" id="fileNameVue">
		<h1>Hola Mundo</h1>		
	</div>
</template>

<script>
	var html,thisx;
	module.exports = {
	    mounted: function(){
	        thisx = this;
			html = $("#fileNameVue");
	        console.log("Component Ready 123!");
	        setTimeout(()=>{
	        	//functions init
	        })
	    },data: function() {
	        return {
	        	fecha: ''
	        	,monto: ''
	        }
	    },
	    methods:{
	    	funcName_1: function(){

	        }
	    }
	}
</script>

<style>
.bg {
    background-color: #C6D2F9;
}
</style>