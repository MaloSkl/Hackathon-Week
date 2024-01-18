import { Button, Menu, MenuButton, MenuList, MenuItem } from "@chakra-ui/react";
import { BsChevronDown } from "react-icons/bs";

const SortBy = () => {
  return (
    <Menu>
      <MenuButton as={Button} rightIcon={<BsChevronDown />} marginLeft="10px">
        Trier
      </MenuButton>
      <MenuList>
        <MenuItem>Trier par A à Z</MenuItem>
        <MenuItem>Trier par Z à A</MenuItem>
        <MenuItem>Trier par région</MenuItem>
      </MenuList>
    </Menu>
  );
};

export default SortBy;
