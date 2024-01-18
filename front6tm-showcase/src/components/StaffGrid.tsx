import React, { useState, useEffect } from "react";
import { SimpleGrid } from "@chakra-ui/react";
import PersonCard from "./PersonCard";
import FetchApi from "./FetchApi";

function StaffGrid() {
  const apiData = FetchApi();

  return (
    <SimpleGrid
      columns={{ sm: 1, md: 2, lg: 3, xl: 5 }}
      padding="10px"
      spacing={10}
    >
      {apiData.map((person, index) => (
        <PersonCard key={index} person={person} />
      ))}
    </SimpleGrid>
  );
}

export default StaffGrid;
