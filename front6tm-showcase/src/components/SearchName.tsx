import React from "react";
import { Input } from "@chakra-ui/react";

const SearchName = () => {
  return (
    <Input
      width={1000}
      borderRadius={20}
      placeholder="Chercher un employé..."
      variant="filled"
      borderWidth="1px"
      borderColor={"#51767A"}
      _hover={{ borderColor: "#C5C2FF" }}
    />
  );
};

export default SearchName;
