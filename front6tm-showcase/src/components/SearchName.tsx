import React from "react";
import { Input } from "@chakra-ui/react";

const SearchName = () => {
  return (
    <Input
      borderRadius={20}
      placeholder="Chercher un employé..."
      variant="filled"
      borderWidth="1px"
      borderColor={"#C5C2FF"}
      _hover={{ borderColor: "#007BFF" }}
    />
  );
};

export default SearchName;
