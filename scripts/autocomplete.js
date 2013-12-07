function DropDownTextToBox(objDropdown, strTextboxId) {
        document.getElementById(strTextboxId).value = objDropdown.options[objDropdown.selectedIndex].value;
        DropDownIndexClear(objDropdown.id);
        document.getElementById(strTextboxId).focus();
    }
    function DropDownIndexClear(strDropdownId) {
        if (document.getElementById(strDropdownId) != null) {
            document.getElementById(strDropdownId).selectedIndex = -1;
        }
    }
