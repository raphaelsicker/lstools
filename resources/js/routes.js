import ContentExemple from "./vue/pages/ContentExemple";
import Teste from "./vue/pages/Teste";

import Estados from "./vue/pages/Estados/index";
import Estado from "./vue/pages/Estados/edit";


import Cities from "./vue/pages/City/index";


import Bairros from "./vue/pages/Bairros/index";
import Localidades from "./vue/pages/Localidades/index";
import Privilegios from "./vue/pages/Privilegios/index";

import SaidasDeCampo from "./vue/pages/SaidasDeCampo/index";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: ContentExemple
    },
    {
        name: 'teste',
        path: '/teste',
        component: Teste
    },
    {
        name: 'cities',
        path: '/forms/cities',
        component: Cities,
        children: [{
            path: ':id',
            component: Cities
        }]
    },





    {
        name: 'cadastros.estados',
        path: '/cadastros/estados',
        component: Estados,
    },
    {
        name: 'cadastros.estados.edit',
        path: '/cadastros/estados/:id',
        component: Estado
    },

    {
        name: 'cadastros.bairros',
        path: '/cadastros/bairros',
        component: Bairros,
        children: [{
            path: ':id',
            component: Bairros
        }]
    },
        {
        name: 'cadastros.localidades',
        path: '/cadastros/localidades',
        component: Localidades,
        children: [{
            path: ':id',
            component: Localidades
        }]
    },
    {
        name: 'congregacao.privilegios',
        path: '/congregacao/privilegios',
        component: Privilegios,
        children: [{
            path: ':id',
            component: Privilegios
        }]
    },
    {
        name: 'pregacao.saidas_de_campo',
        path: '/pregacao/saidas_de_campo',
        component: SaidasDeCampo,
        children: [{
            path: ':id',
            component: SaidasDeCampo
        }]
    }
];


