
plugin.tx_cookiedataprivacy_ext1 {
  view {
    templateRootPaths.0 = EXT:cookie_data_privacy/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_cookiedataprivacy_ext1.view.templateRootPath}
    partialRootPaths.0 = EXT:cookie_data_privacy/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_cookiedataprivacy_ext1.view.partialRootPath}
    layoutRootPaths.0 = EXT:cookie_data_privacy/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_cookiedataprivacy_ext1.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_cookiedataprivacy_ext1.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
  settings{
    dataRequired = {$plugin.tx_cookiedataprivacy_ext1.settings.dataRequired}
    dataCheckbox1 = {$plugin.tx_cookiedataprivacy_ext1.settings.dataCheckbox1}
    data_privacy_contact_form = {$plugin.tx_cookiedataprivacy_ext1.settings.dataCheckbox2}
  }
}

### Include CSS ###
page.includeCSS {
  fileCookieIncludeCss001 = EXT:cookie_data_privacy/Resources/Public/css/cookieconsent.min.css
  fileCookieIncludeCss002 = EXT:cookie_data_privacy/Resources/Public/css/common.css
}
### Include JS ###
[globalVar = LIT:0 < {$plugin.tx_cookiedataprivacy_ext1.settings.enableJquery}]
  page.includeJS {
    fileCookieIncludeJs001 = EXT:cookie_data_privacy/Resources/Public/js/jquery.min.js
    fileCookieIncludeJs001.forceOnTop = 1
  }
[end]
page.includeJS{
  fileCookieIncludeJs002 = EXT:cookie_data_privacy/Resources/Public/js/cookieconsent.min.js
}

page.15035 = USER
page.15035 {
  userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
  pluginName = Ext1
  extensionName = CookieDataPrivacy
  vendorName = TYPO3Liebhaber
  action = show
  view < plugin.tx_cookiedataprivacy_ext1.view
  persistence < plugin.tx_cookiedataprivacy_ext1.persistence
}

plugin.tx_cookiedataprivacy._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-cookie-data-privacy table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-cookie-data-privacy table th {
        font-weight:bold;
    }

    .tx-cookie-data-privacy table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)