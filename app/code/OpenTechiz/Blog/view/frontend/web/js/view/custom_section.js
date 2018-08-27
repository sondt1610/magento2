define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {

    return Component.extend({
        initialize: function () {
            //customerData.get('custom_section') call to get method and send request ajax to server
            //to get data from section: custom_section.
            //this.custom_sectio: init custom_sectio attribute of object. Then we can get this object in template html
            this.custom_secti = customerData.get('custom_section');
            //call and extend "initialize" method of uicomponent (parent) (JavaScript class of a UI component is implemented.)
            this._super();
            //console.log('2222');
            //console.log(this._super());
            //console.log(this.custom_section);
        }
    });
});