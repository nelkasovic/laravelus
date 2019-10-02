/*
 *  Document   : settings.js
 *  Author     : pixelcave
 *  Description: Various small tools
 *
 */

// Import global dependencies
import './../bootstrap';

// Tools
export default class Settings {
    /*
     * Updates the color theme
     *
     */
    static updateSetting(key, value) {
        if (key && value) {
            $.ajax({
                type: "POST",
                url: "/xhr/settings/update",
                data: { key: key, value: value },
                dataType: "JSON",
                beforeSend: function () {
                    console.log('Updating settings over /xhr/settings/update...');
                },
                success: function (data) {
                    if (data.success) {
                        console.log(data.result);
                    }
                }
            });
        }
    }
}