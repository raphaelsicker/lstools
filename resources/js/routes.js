import ContentExemple from "./vue/pages/ContentExemple";

import City from "./vue/pages/City/index";
import Ufs from "./vue/pages/Uf/index";
import ServiceGroups from "./vue/pages/ServiceGroup/index";
import Cards from "./vue/pages/Card/index";
import CardsPrinter from "./vue/pages/Card/printer";
import Addresses from "./vue/pages/Address/index";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: ContentExemple
    },
    {
        name: 'cities',
        path: '/forms/cities',
        component: City,
        children: [{
            path: ':id',
            component: City
        }]
    },
    {
        name: 'ufs',
        path: '/forms/ufs',
        component: Ufs,
        children: [{
            path: ':id',
            component: Ufs
        }]
    },
    {
        name: 'service-groups',
        path: '/forms/service-groups',
        component: ServiceGroups,
        children: [{
            path: ':id',
            component: ServiceGroups
        }]
    },

    {
        name: 'cards-printer',
        path: '/maps/printer',
        component: CardsPrinter
    },
    {
        name: 'cards',
        path: '/maps/cards',
        component: Cards,
        children: [
            {
                path: ':id',
                component: Cards
            }
        ]
    },
    {
        name: 'addresses',
        path: '/maps/addresses',
        component: Addresses,
        children: [{
            path: ':id',
            component: Addresses
        }]
    }
];


