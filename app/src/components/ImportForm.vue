<script>
    import axios from 'axios'

    export default {
        name: "App",
        data() {
        return {
            data: {},
            file: [],
            name: '',
            resultUpload: '',
        };
        },
        methods: {
            getfile(){
                this.file = this.$refs.file.files[0];
                this.name = this.file.name;
            },
            async uploadfile(){
                let formData = new FormData();
                formData.append('arquivo', this.file);

                axios.post('http://127.0.0.1:8000/api/import',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(data) {
                    this.resultUpload = 'Arquivo importado com sucesso!';
                    console.log('success');
                    console.log(data);
                }.bind(this)).catch(function(data) {
                    console.log('error');
                    this.resultUpload = 'Ocorreu um erro no envio do arquivo!';
                });
            }
        },
        beforeMount() {
        },  
    };
</script>

<template>
    <h5>Importar o arquivo de Colaboradores com o último domingo de folga:</h5>
    <input type="file" name="arquivo" id="arquivo" ref="file" @change="getfile"><button @click="uploadfile">Importar</button>
    {{ resultUpload }}
</template>

<style scoped>
h5 {
    font-size: 1rem;
    font-style: oblique;
    font-weight: bold;
}

#arquivo {
    border: 1px #CCCCCC solid;
    height: 23px;
    position: relative;
    top: 0px;
}

button {
    border: 1px #000000 solid;
    height: 23px;
    width: 100px;
    color: white;
    background-color: green;
    font-weight: bold;
}
</style>
