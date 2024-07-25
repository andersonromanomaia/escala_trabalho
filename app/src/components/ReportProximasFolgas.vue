<script>
    import axios from 'axios'

    
    export default {
        name: "App",
        data() {
            return {
                meses: {},
                filiais: {},
                folgas: {},
                ano: new Date().getFullYear(),
                ano_valid: new Date().getFullYear(),
                mes: '',
                filial: '',
            };
        },
        methods: {
            async getFilial() {
                const { data } = await axios.get("http://127.0.0.1:8000/api/listarfiliais");
                this.filiais = data;
            },
            async getFolgas() {
                const { data } = await axios.get("http://127.0.0.1:8000/api/reportfolgas?ano="+this.ano+"&mes="+this.mes+"&filial="+this.filial);                
                this.folgas = data;
            }
        },
        beforeMount() {
            this.getFilial();
        },  
    };
</script>
<template>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <br><h5>Relatório das Folgas dos colaboradores, conforme pesquisa abaixo:</h5>
                <div class="item">
                    <input type="number" id="ano" name="ano" v-model="ano" placeholder="Ano" @input="() => { if(ano < ano_valid) { ano = ano_valid }}">
                    <select id="mes" name="mes" v-model="mes">
                        <option value="">Escolha um Mês</option>
                        <option v-for="n in 12">{{ n }}</option>
                    </select>
                    <select id="filial" name="filial" v-model="filial">
                        <option value="">Escolha a Filial</option>
                        <option 
                        v-for="filial_item in filiais.data" 
                        v-bind:key="filial_item.filial_codigo">{{ filial_item.filial_codigo }}</option>
                    </select>
                    <button @click="getFolgas()">Emitir</button>
                </div>
          </div>
          <div class="card-body">            
            <div class="item">
                <table>
                    <thead>
                        <tr>
                            <th colspan="5">
                                <h1>RELATÓRIO DE FOLGA DOS COLABORADORES</h1>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                Mês: {{ mes }}/{{ ano }}
                                &nbsp;&nbsp;
                                Filial: {{ filial }}
                            </th>
                        </tr>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nome</th>
                            <th>Ciclo</th>
                            <th>Última Folga</th>
                            <th>Folgas no mês</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="folga_item in folgas"
                        v-bind:key="folga_item.data">
                            <td>{{ folga_item.matricula }}</td>
                            <td>{{ folga_item.nome }}</td>
                            <td>{{ folga_item.ciclo }}</td>
                            <td>{{ folga_item.ultima_folga }}</td>
                            <td>
                                <dias v-for="item in folga_item.folgas_mes"
                                    v-bind:key="item.dia">
                                    {{ item.dia }}&nbsp;
                                </dias>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<style scoped>

.item {
  margin-top: 2rem;
  display: flex;
  position: relative;
}

h5 {
    font-size: 1rem;
    font-style: oblique;
    font-weight: bold;
}

#ano {
    border: 1px #CCCCCC solid;
    width: 50%;
    font-size: 1rem;
}

#mes {
    border: 1px #CCCCCC solid;
    width: 50%;
    font-size: 1rem;
}

#filial {
    border: 1px #CCCCCC solid;
    width: 50%;
    font-size: 1rem;
}

button {
    border: 1px black solid;
    height: 24px;
    width: 100px;
    color: white;
    background-color: green;
    font-weight: bold;
}

table{
    border: 3px black solid;
    border-collapse: collapse;
}

table th{
    text-align: center;
    border: 1px black solid;
    font-weight: bold;
}

table tr{
    text-align: center;
}

table td{    
    border: 1px black solid;
}

dias{
    /* font-weight: bold; */
    font-style: oblique;
}

input{
    text-align: center;
    height: 24px;

}

select{
    text-align: center;
    height: 24px;

}

@media (min-width: 1024px) {
  .item {
    margin-top: 0;
  }
}
</style>
