const path = require("path");

module.exports = {
	devServer: {
		host: 'localhost'
	},
	outputDir: path.resolve(__dirname, '../../../public/vue-dist/vuetemplater/'),
	assetsDir: 'assets/',
	filenameHashing: false
}