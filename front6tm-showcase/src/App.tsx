import { Grid, GridItem, Show, Heading, HStack } from "@chakra-ui/react";
import NavBar from "./components/NavBar";
import StaffGrid from "./components/StaffGrid";
import JobSelector from "./components/JobSelector";
import { useState } from "react";
import SortBy from "./components/SortBy";
import SearchName from "./components/SearchName";

function App() {
  const [selectedJob, setSelectedJob] = useState<string>("");

  return (
    <Grid
      templateAreas={{
        base: `"navbar" "trombi"`,
        lg: `"navbar navbar" "trombi"`,
      }}
    >
      <GridItem area="navbar" bg="#3A424E">
        <NavBar />
      </GridItem>
      <GridItem area="trombi" padding="15px">
        <HStack justifyContent={"space-between"}>
          <Heading mb={4} marginY={10} marginX={5}>
            TROMBINOSCOPE
          </Heading>
          <SearchName />
          <HStack marginRight={4}>
            <JobSelector />
            <SortBy />
          </HStack>
        </HStack>
        <StaffGrid />
      </GridItem>
    </Grid>
  );
}

export default App;
