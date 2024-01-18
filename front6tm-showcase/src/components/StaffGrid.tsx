import { SimpleGrid } from "@chakra-ui/react";
import Data from "../assets/data.json";
import PersonCard from "./PersonCard";

function StaffGrid() {
  return (
    <SimpleGrid
      columns={{ sm: 1, md: 2, lg: 3, xl: 5 }}
      padding="10px"
      spacing={10}
    >
      {Data.map((person, index) => (
        <PersonCard key={index} person={person} />
      ))}
    </SimpleGrid>
  );
}

export default StaffGrid;
