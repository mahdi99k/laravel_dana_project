import fs from 'fs';
const filePath = 'build/index.js';
const originalContent = fs.readFileSync(filePath, 'utf8');
const modifiedContent = originalContent.replace(/3000/g, '5174');

fs.writeFileSync(filePath, modifiedContent, 'utf8');
console.log('Port changed from 3000 to 5174 in build/index.js');