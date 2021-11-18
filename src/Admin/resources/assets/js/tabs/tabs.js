class Tabs {
    constructor() {
        this.formContainer = $('.js-edit-form');
        this.formDefaultActionUrl = this.formContainer.attr('action');
    }

    /**
     * Функция при нажатии на таб
     */
    onClickTab() {
        $('.nav-tabs a').click((event) => {
            let $buttonTab = $(event.target);
            let tabId = $buttonTab.attr('href');

            this.insertIdInActionForm(tabId);
            this.addInUrlTabId(tabId);
        })
    }

    /**
     * Вставим ИД таба в кнопку сохранения, чтобы при перезагрузке
     * остаться на этом же табе.
     */
    insertIdInActionForm(tabId) {
        this.formContainer.attr('action', this.formDefaultActionUrl + tabId);
    }

    addInUrlTabId(tabId) {
        if(history.pushState) {
            history.pushState(null, null, tabId);
        }
        else {
            location.hash = tabId;
        }
        // window.location.hash = tabId;
    }
}

$(function () {
    let tabs = new Tabs();
    tabs.onClickTab()
});