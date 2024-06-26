// import node from '@sveltejs/adapter-node';
import node from '@sveltejs/adapter-node';
// import pkg from './package.json';

const config = {
  kit: {
    // By default, `npm run build` will create a standard Node.js application.
    // You can create optimized builds for different platforms by
    // specifying a different adapter
    adapter: node(),
    // hydrate the <div id="svelte"> element in src/app.html
    // target: '#svelte',
    // vite: {
    //   ssr: {
    //     noExternal: Object.keys(pkg.dependencies || {})
    //   }
    // }
  }
};

export default config;
