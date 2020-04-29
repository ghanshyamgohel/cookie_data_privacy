
plugin.tx_cookiedataprivacy_ext1 {
  view {
    # cat=plugin.tx_cookiedataprivacy_ext1/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:cookie_data_privacy/Resources/Private/Templates/
    # cat=plugin.tx_cookiedataprivacy_ext1/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:cookie_data_privacy/Resources/Private/Partials/
    # cat=plugin.tx_cookiedataprivacy_ext1/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:cookie_data_privacy/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_cookiedataprivacy_ext1//a; type=string; label=Default storage PID
    storagePid =
  }
  settings {
    # cat=plugin.tx_cookiedataprivacy_ext1/enable/01; type=boolean; label=Use default language label
    enableLanguage = 1
    # cat=plugin.tx_cookiedataprivacy_ext1/enable/02; type=boolean; label=Include jQuery library
    enableJquery = 0

    # cat=plugin.tx_cookiedataprivacy_ext1/language/01; type=string; label=Cookie Header
    cookieHeader = Header
    # cat=plugin.tx_cookiedataprivacy_ext1/language/02; type=string; label=Cookie Message
    cookieMessage = This website uses cookies to ensure you get the best experience on our website.
    # cat=plugin.tx_cookiedataprivacy_ext1/language/03; type=string; label=Cookie Dismiss
    cookieDismiss = Dismiss
    # cat=plugin.tx_cookiedataprivacy_ext1/language/04; type=string; label=Cookie Allow
    cookieAllow = Accept
    # cat=plugin.tx_cookiedataprivacy_ext1/language/05; type=string; label=Cookie Deny
    cookieDeny = Deny
    # cat=plugin.tx_cookiedataprivacy_ext1/language/06; type=string; label=Cookie Read More Link
    cookieLink = Read more
    # cat=plugin.tx_cookiedataprivacy_ext1/language/07; type=string; label=Cookie Revoke Button
    cookieRevoke = Revoke
    # cat=plugin.tx_cookiedataprivacy_ext1/language/08; type=string; label=Data Privacy: Required field error message
    dataRequired = This value is required.
    # cat=plugin.tx_cookiedataprivacy_ext1/language/09; type=string; label=Data Privacy checkbox 1 message
    dataCheckbox1 = *Yes, I have read the <a href="/privacy-policy" target="_blank">privacy policy</a> and <a href="/cookie-policy" target="_blank">cookie policy</a> of company GmbH and I agree with it.
    # cat=plugin.tx_cookiedataprivacy_ext1/language/10; type=string; label=Data Privacy checkbox 2 Newsletter message
    dataCheckbox2 = *Yes, I would like to receive information according to my request from the company GmbH and I agree that the company GmbH processes my personal data (name, e-mail address) to process my request. company GmbH only transfers the personal data to processors (for example, IT service providers). This consent can be revoked by you at any time free of charge and without giving reasons by sending an e-mail with the subject "Withdrawal" to <a href="mailto:office@domain.at">office(at)domain.at</a>.
  }
}
