### Include JS/CSS : system generated file, please donot add or modify ###
<f:if condition="{privacyConfigs.jsPathExternal}"><f:if condition="{privacyConfigs.inFooter}"><f:then>
[globalString = IENV:HTTP_HOST= {privacyConfigs.domain}]
page.includeJSFooter{<f:for each="{privacyConfigs.jsPathExternal}" as="jsPathList" iteration="Iteration1"><f:if condition="{jsPathList.path}">
	cookieIncludeJs00{Iteration1.cycle} = {jsPathList.path}</f:if></f:for>
}
[end]</f:then><f:else>
[globalString = IENV:HTTP_HOST= {privacyConfigs.domain}]
page.includeJS{<f:for each="{privacyConfigs.jsPathExternal}" as="jsPathList" iteration="Iteration1"><f:if condition="{jsPathList.path}">
	cookieIncludeJs00{Iteration1.cycle} = {jsPathList.path}</f:if></f:for>
}
[end]</f:else></f:if></f:if>
<f:if condition="{privacyConfigs.cssPathExternal}">
[globalString = IENV:HTTP_HOST= {privacyConfigs.domain}]
page.includeCSS{<f:for each="{privacyConfigs.cssPathExternal}" as="cssPathList" iteration="Iteration1"><f:if condition="{cssPathList.path}">
	cookieIncludeCss00{Iteration1.cycle} = {cssPathList.path}</f:if></f:for>
}
[end]</f:if>

### For TYPO3 v10x ###
<f:if condition="{privacyConfigs.jsPathExternal}"><f:if condition="{privacyConfigs.inFooter}"><f:then>[request.getNormalizedParams().getRequestHostOnly()== "{privacyConfigs.domain}"]
page.includeJSFooter{<f:for each="{privacyConfigs.jsPathExternal}" as="jsPathList" iteration="Iteration1"><f:if condition="{jsPathList.path}">
	cookieIncludeJs00{Iteration1.cycle} = {jsPathList.path}</f:if></f:for>
}
[end]</f:then><f:else>[request.getNormalizedParams().getRequestHostOnly()== "{privacyConfigs.domain}"]
page.includeJS{<f:for each="{privacyConfigs.jsPathExternal}" as="jsPathList" iteration="Iteration1"><f:if condition="{jsPathList.path}">
	cookieIncludeJs00{Iteration1.cycle} = {jsPathList.path}</f:if></f:for>
}
[end]</f:else></f:if></f:if>
<f:if condition="{privacyConfigs.cssPathExternal}">
[request.getNormalizedParams().getRequestHostOnly()== "{privacyConfigs.domain}"]
page.includeCSS{<f:for each="{privacyConfigs.cssPathExternal}" as="cssPathList" iteration="Iteration1"><f:if condition="{cssPathList.path}">
	cookieIncludeCss00{Iteration1.cycle} = {cssPathList.path}</f:if></f:for>
}
[end]</f:if>