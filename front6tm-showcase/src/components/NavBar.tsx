import { HStack, Heading, Image, Text } from "@chakra-ui/react";
import React from "react";
import EditColorMode from "./EditColorMode";
import SearchName from "./SearchName";

function NavBar() {
  return (
    <HStack justifyContent={"space-between"}>
      <Image
        src="https://www.6tm.com/app/uploads/2023/09/6tm_title-001.svg"
        padding="15px"
      />
      <SearchName />
      <EditColorMode />
    </HStack>
  );
}

export default NavBar;
