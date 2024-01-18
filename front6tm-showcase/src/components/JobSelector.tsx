import React from "react";
import { Button, Menu, MenuButton, MenuList, MenuItem } from "@chakra-ui/react";
import { BsChevronDown } from "react-icons/bs";
import Data from "../assets/data.json";

const JobSelector = () => {
  const uniqueJobPositions = new Set();

  Data.forEach((person) => {
    uniqueJobPositions.add(person.poste);
  });

  const uniqueJobArray = Array.from(uniqueJobPositions);

  return (
    <Menu>
      <MenuButton as={Button} rightIcon={<BsChevronDown />} marginLeft="15px">
        Poste
      </MenuButton>
      <MenuList>
        {uniqueJobArray.map((job, index) => (
          <MenuItem key={index}>{job}</MenuItem>
        ))}
      </MenuList>
    </Menu>
  );
};

export default JobSelector;
