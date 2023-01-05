import Home from './components/Index.vue';
import AllBrandsWithDisplayItems from './components/BrandsWithStocks.vue';
import AllStylesWithDisplayItems from './components/StylesWithStocks.vue';
import AllStocklist from './components/AllStocklist.vue';
import ViewStockDetail from './components/StockDetail.vue';

import ContactUs from './components/ContactUs.vue';
import AboutUs from './components/AboutUs.vue';

const websiteLink = 'https://www.manilawatch.com';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        props: { websiteLink }
    },
    {
        name: 'brands with display stocks',
        path: '/stocks/brands',
        component: AllBrandsWithDisplayItems,
        props: { websiteLink }
    },
    {
        name: 'styles with display stocks',
        path: '/stocks/brands/:id',
        component: AllStylesWithDisplayItems,
        props: { websiteLink }
    },
    {
        name: 'stocklist display',
        path: '/stocklist/:category/:brandId/:styleId',
        component: AllStocklist,
        props: { websiteLink }
    },
    {
        name: 'stocklist display with keyword',
        path: '/stocklist/:keyword',
        component: AllStocklist,
        props: { websiteLink }
    },
    {
        name: 'stocklist all display',
        path: '/stocklist/',
        component: AllStocklist,
        props: { websiteLink }
    },
    {
        name: 'stock detail',
        path: '/stock_detail/:stockId',
        component: ViewStockDetail,
        props: { websiteLink }
    },
    {
        name: 'contact us page',
        path: '/contact_us',
        component: ContactUs,
        props: { websiteLink }
    },
    {
        name: 'about us page',
        path: '/about_us',
        component: AboutUs,
        props: { websiteLink }
    }
];