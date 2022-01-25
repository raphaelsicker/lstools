import ContentExemple from "./vue/pages/ContentExemple";

import City from "./vue/pages/City/index";
import Ufs from "./vue/pages/Uf/index";
import ServiceGroups from "./vue/pages/ServiceGroup/index";

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
];


