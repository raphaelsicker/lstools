<template>
    <div id="styleSelector">
        <div class="selector-toggle">
            <a href="javascript:void(0)"></a>
        </div>
        <ul>
            <li>
                <p class="selector-title">Style Selector</p>
            </li>
            <li class="theme-option">
                <span class="sub-title">Header BG Color Option</span>
                <div id="theme-color">
                    <a href="#" class="header-bg" hoe-color-type="header-bg1">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg2">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg3">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg4">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg5">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg6">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg7">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg8">&nbsp;</a>
                    <a href="#" class="header-bg" hoe-color-type="header-bg9">&nbsp;</a>
                </div>
            </li>
            <li class="theme-option">
                <span class="sub-title">Left Panel BG Color Option</span>
                <div id="theme-color">
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg1">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg2">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg3">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg4">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg5">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg6">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg7">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg8">&nbsp;</a>
                    <a href="#" class="lpanel-bg" hoe-color-type="lpanel-bg9">&nbsp;</a>
                </div>
            </li>
            <li class="theme-option">
                <span class="sub-title">Logo Color BG Option</span>
                <div id="theme-color">
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg1">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg2">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg3">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg4">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg5">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg6">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg7">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg8">&nbsp;</a>
                    <a href="#" class="logo-bg" hoe-color-type="logo-bg9">&nbsp;</a>
                </div>
            </li>
            <li class="theme-option">
                <span class="sub-title">Theme Background BG Option</span>
                <div id="theme-color">
                    <a href="#" class="theme-bg" hoe-themebg-type="bg1">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg2">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg3">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg4">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg5">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg6">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg7">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg8">&nbsp;</a>
                    <a href="#" class="theme-bg" hoe-themebg-type="bg9">&nbsp;</a>
                </div>
            </li>
            <li class="theme-option">
                <span class="sub-title">Theme Layout</span>
                <select id="theme-layout" class="form-control minimal input-sm">
                    <option name="theme-layout" value="wide-layout">Wide Layout</option>
                    <option name="theme-layout" value="box-layout">Boxed Layout</option>
                </select>
            </li>
            <li class="theme-option">
                <span class="sub-title">SideBar Effect</span>
                <select id="leftpanel-effect" class="form-control minimal input-sm">
                    <option name="lpanel-effect" value="shrink">Default</option>
                    <option name="lpanel-effect" value="overlay">Overlay</option>
                    <option name="lpanel-effect" value="push">Push</option>
                </select>
            </li>
            <li class="theme-option">
                <span class="sub-title">Navigation Type</span>
                <select id="navigation-type" class="form-control minimal input-sm">
                    <option name="navigation-type" value="vertical">Vertical</option>
                    <option name="navigation-type" value="vertical-compact">Vertical Compact</option>
                    <option name="navigation-type" value="horizontal">Horizontal</option>
                    <option name="navigation-type" value="horizontal-compact">Horizontal compact</option>
                </select>
            </li>
            <li class="theme-option">
                <span class="sub-title">Navigation Side</span>
                <select id="navigation-side" class="form-control minimal input-sm">
                    <option name="navigation-side" value="leftside">Left</option>
                    <option name="navigation-side" value="rightside">Right</option>
                </select>
            </li>
            <li class="theme-option">
                <span class="sub-title">Sidebar Position</span>
                <select id="sidebar-position" class="form-control minimal input-sm">
                    <option name="sidebar-position" value="default">Default</option>
                    <option name="sidebar-position" value="fixed">Fixed</option>
                </select>
            </li>
        </ul>
    </div>

</template>

<script>
    export default {
        name: "RightPanel"
    }
</script>

<style scoped>

</style>
