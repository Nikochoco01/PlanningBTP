const tabs = document.querySelectorAll('[data-tab-value]') // button
const tabInfos = document.querySelectorAll('[data-tab-info]') // content

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabValue);

        tabInfos.forEach(tabInfo => {
            tabInfo.classList.remove('active');
            //target.classList = '';
        })
        target.classList.add('active');
       // target.classList.add('active');
    })
})